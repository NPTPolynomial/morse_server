/**
 * BasicHTTPClient.ino
 *
 *  Created on: 24.05.2015
 *
 */
// my chnages Leo
#include <Arduino.h>

#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>

#include <ESP8266HTTPClient.h>

#include <Wtv020sd16p.h>

int resetPin = 5; // The pin number of the reset pin.
int clockPin = 0; // The pin number of the clock pin.
int dataPin = 4; // The pin number of the data pin.
int busyPin = 13; // The pin number of the busy pin.
int toATtiny = 12;

Wtv020sd16p wtv020sd16p(resetPin, clockPin, dataPin, busyPin);

#define USE_SERIAL Serial
#include <string.h>
#define MAX_STRING_LEN 20

//String SERVER_URL = "192.168.1.242";

//String SERVER_URL = "192.168.0.106";
String SERVER_URL = "192.168.1.19";
String SERVER_PAGE = "/morse_server/";

//int unusedPin = a1;

String NODE_NAME = "a";
String ALL_NODES[2] = {"a", "b"};

String receiveInstructionURL = SERVER_PAGE + "receive.php?node=" + NODE_NAME;

int firstMsgIndex = 9;
int firstByeIndex = 41;
int totalAudio = 49;
int counter;
const int minProtectionTime = 15000; // 1500 delay * 10 seconds 

ESP8266WiFiMulti WiFiMulti;

unsigned long prevMillis = 0;

const int sleepTimeS = 10;

void setup() {
  wtv020sd16p.reset();

  counter = 0;
  pinMode(toATtiny, OUTPUT);

  USE_SERIAL.begin(115200);
  // USE_SERIAL.setDebugOutput(true);

  USE_SERIAL.println();
  USE_SERIAL.println();
  USE_SERIAL.println();

  pinMode(BUILTIN_LED, OUTPUT);


//  for (uint8_t t = 4; t > 0; t--) {
//    USE_SERIAL.printf("[SETUP] WAIT %d...\n", t);
//    USE_SERIAL.flush();
//    digitalWrite(BUILTIN_LED, LOW);   // Turn the LED on (Note that LOW is the voltage level
//    // but actually the LED is on; this is because
//    // it is acive low on the ESP-01)
//    delay(1000);                      // Wait for a second
//    digitalWrite(BUILTIN_LED, HIGH);  // Turn the LED off by making the voltage HIGH
//
//    delay(1000);
//    
//  }
  delay(1000);
//  WiFiMulti.addAP("XPS_2G", "1985517000");
  WiFiMulti.addAP("Eds-Studio-2ghz", "DesignStudio2015");

  pinMode(A0, INPUT);

  randomSeed(analogRead(A0));

}

void loop() {
  // wait for WiFi connection
  USE_SERIAL.print("busy pin: ");
  USE_SERIAL.println(digitalRead(busyPin));


  if ((WiFiMulti.run() == WL_CONNECTED)
    && counter < minProtectionTime
    && digitalRead(busyPin) == LOW
     ) {

//    for (int i = 0; i < 20; i++) {
//      digitalWrite(BUILTIN_LED, LOW);   // Turn the LED on (Note that LOW is the voltage level
//      // but actually the LED is on; this is because
//      // it is acive low on the ESP-01)
//      delay(500);                      // Wait for a second
//      digitalWrite(BUILTIN_LED, HIGH);  // Turn the LED off by making the voltage HIGH
//
//
//      delay(500);
//    }


    prevMillis = millis();
    HTTPClient http;

    USE_SERIAL.print("[HTTP] begin...\n");
    // configure traged server and url
    //http.begin("192.168.1.12", 443, "/test.html", true, "7a 9c f4 db 40 d3 62 5a 6e 21 bc 5c cc 66 c8 3e a1 45 59 38"); //HTTPS
    http.begin(SERVER_URL, 80, receiveInstructionURL); //HTTP

    USE_SERIAL.print("[HTTP] GET...\n");
    // start connection and send HTTP header
    int httpCode = http.GET();
    if (httpCode) {


      // HTTP header has been send and Server response header has been handled
      USE_SERIAL.printf("[HTTP] GET... code: %d\n", httpCode);

      // file found at server
      if (httpCode == 200) {
        String payload = http.getString();

        int commaIndex = payload.indexOf(',');
        int secondCommaIndex = payload.indexOf(',', commaIndex + 1);
        int thirdCommaIndex = payload.indexOf(',', secondCommaIndex + 1);
        int forthCommaIndex = payload.indexOf(',', thirdCommaIndex + 1);
        String firstValue = payload.substring(0, commaIndex);
        String secondValue = payload.substring(commaIndex + 1, secondCommaIndex);
        String thirdValue = payload.substring(secondCommaIndex + 1, thirdCommaIndex); //To the end of the string
        String forthValue = payload.substring(thirdCommaIndex + 1, forthCommaIndex); //To the end of the string
        int fifthValue = payload.substring(forthCommaIndex + 1).toInt();
        USE_SERIAL.println("first: " + firstValue);
        USE_SERIAL.println("secondValue: " + secondValue);
        USE_SERIAL.println("thirdValue: " + thirdValue);
        USE_SERIAL.println("forthValue: " + forthValue);
        USE_SERIAL.println("fifthValue: " + fifthValue);

        USE_SERIAL.println(payload);

        if (firstValue == "hello") {
          USE_SERIAL.println("It worked. I have a hello");
          USE_SERIAL.println("Sending a message back to the server...");

          int count = forthValue.toInt() + 1;

          String type;
          int isEnd;

          int dial_id;

          if (thirdValue == "0") {
            // time to hello back
            dial_id = random(1, firstMsgIndex);

            type = "hello";
            isEnd = 1;
          } else {
            // it was the last hello, move to message phase
            if (fifthValue > 10){
              dial_id = random(firstMsgIndex, firstMsgIndex + 10);
            } else if (fifthValue >5){
              dial_id = random(firstMsgIndex + 10, firstMsgIndex + 20);
            } else {
              dial_id = random(firstMsgIndex + 20, firstByeIndex);
            }

            type = "message";
            isEnd = 0;
          }

          String parameters = SERVER_PAGE + "send.php?from=" + NODE_NAME + "&to=" +
                              secondValue + "&type=" + type + "&end=" +
                              isEnd + "&dial_id=" + dial_id + "&count=" + count;

          http.begin(SERVER_URL, 80, parameters); //HTTP
          int httpCode2 = http.GET();
          USE_SERIAL.println(parameters);
          USE_SERIAL.printf("[HTTP] Returned... code: %d\n", httpCode2);
          String sendReturn = http.getString();
          USE_SERIAL.println(sendReturn);

          if (sendReturn != "Duplicate hello entry. Entry dropped." && httpCode2 == 200) {
            wtv020sd16p.playVoice(dial_id - 1);

            delay(1000);
            USE_SERIAL.println("I am playing");
                        delay(1000);
            USE_SERIAL.println("I am playing");
                        delay(1000);
            USE_SERIAL.println("I am playing");            
            delay(1000);
            USE_SERIAL.println("I am playing");            
            delay(1000);
            USE_SERIAL.println("I am playing");
          }


//          USE_SERIAL.println("before sleep");
//          ESP.deepSleep(sleepTimeS * 1000000, WAKE_RF_DEFAULT);
//          USE_SERIAL.println("after sleep");

        } else if (firstValue == "message") {
          USE_SERIAL.println("It worked. I have a message");

          USE_SERIAL.println("Sending a message back to the server...");

          int dial_id;
          String type;
          int isEnd;

          if (thirdValue == "0") {

            if (fifthValue > 10){
              dial_id = random(firstMsgIndex, firstMsgIndex + 10);
            } else if (fifthValue >5){
              dial_id = random(firstMsgIndex + 10, firstMsgIndex + 20);
            } else {
              dial_id = random(firstMsgIndex + 20, firstByeIndex);
            }
            

            type = "message";

            if (random(0, 100) <= 70) {
              isEnd = 0;
            } else {
              isEnd = 1;
            }
          } else {
            dial_id = random(firstByeIndex, 30);

            type = "bye";
            isEnd = 0;
          }

          int count = forthValue.toInt() + 1;

          String parameters = SERVER_PAGE + "send.php?from=" + NODE_NAME + "&to=" +
                              secondValue + "&type=" + type + "&end=" +
                              isEnd + "&dial_id=" + dial_id + "&count=" + count;

          http.begin(SERVER_URL, 80, parameters); //HTTP
          int httpCode2 = http.GET();
          String sendReturn = http.getString();
          USE_SERIAL.println(sendReturn);
          if (sendReturn != "Duplicate hello entry. Entry dropped."&& httpCode2 == 200) {
            wtv020sd16p.playVoice(dial_id - 1);
          }
//          USE_SERIAL.println("before sleep");
//          ESP.deepSleep(sleepTimeS * 1000000, WAKE_RF_DEFAULT);
//          USE_SERIAL.println("after sleep");


        }
        else if (firstValue == "bye") {
          USE_SERIAL.println("It worked. I have a bye");

          USE_SERIAL.println("Sending a bye back to the server...");

          int dial_id;
          String type;
          int isEnd;


          // time to message back
          dial_id = random(firstByeIndex, totalAudio + 1);
          wtv020sd16p.playVoice(dial_id - 1);

          type = "bye";
          isEnd = 1;

          int count = forthValue.toInt() + 1;

          String parameters = SERVER_PAGE + "send.php?from=" + NODE_NAME + "&to=" +
                              secondValue + "&type=" + type + "&end=" +
                              isEnd + "&dial_id=" + dial_id + "&count=" + count;

          http.begin(SERVER_URL, 80, parameters); //HTTP
          int httpCode2 = http.GET();

        }
        else if (firstValue == "noRowError") {
          //           maybe initial a conversation? by 30%?
          USE_SERIAL.println("It worked. but I don't have anything to do...");
          int randNum = random (0, 100);
          if (randNum < 100) {

            //            String whoToTalk = randNum % 2 == 0 ? "b":"c";
//            String whoToTalk = "b";
            String whoToTalk;
            do {
              whoToTalk = ALL_NODES[random(0, 2)]; 
            } while (NODE_NAME == whoToTalk);
            
            int dial_id = random(1, firstMsgIndex);

            String parameters = SERVER_PAGE + "send.php?from=" + NODE_NAME + "&to=" +
                                whoToTalk + "&type=" + "hello" + "&end=" +
                                "0" + "&dial_id=" + dial_id + "&count=" + "0";

            http.begin(SERVER_URL, 80, parameters); //HTTP
            int httpCode2 = http.GET();
            USE_SERIAL.println(parameters);
            USE_SERIAL.printf("[HTTP] Returned... code: %d\n", httpCode2);

            String sendReturn = http.getString();
            USE_SERIAL.println(sendReturn);

            if (sendReturn != "Duplicate hello entry. Entry dropped."&& httpCode2 == 200) {
              wtv020sd16p.playVoice(dial_id - 1);
            }


          }


        }
      }
    } else {
      USE_SERIAL.print("[HTTP] GET... failed, no connection or no HTTP server\n");
    }
  }

  counter += 1500;

  if (counter > minProtectionTime && digitalRead(busyPin) == LOW){
    USE_SERIAL.println("ASLDK");
    digitalWrite(toATtiny, HIGH);  
  }

//          USE_SERIAL.println("before sleep");
//          ESP.deepSleep(sleepTimeS * 1000000, WAKE_RF_DEFAULT);
//          USE_SERIAL.println("after sleep");


  delay(1500);
  //  delay(15000);
}

