#include <Arduino.h>

#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>

#include <ESP8266HTTPClient.h>

int toATtiny = 12;

//Wtv020sd16p wtv020sd16p(resetPin, clockPin, dataPin, busyPin);

#define USE_SERIAL Serial
#include <string.h>
#define MAX_STRING_LEN 20

boolean didITalked = false;

String str = "hello";
#define buffer_length 13
char charBuf[buffer_length];
int intBuf[buffer_length];

#define speakerPin 13
#define pitch 440
#define bpm 100
///long bpmdelay = 0;

//Within international morse code the maximum length of a character is 5 'notes'
//The last note of a character is a stop symbol -> therefore length + 1
#define character_length 6
String alphabet_substr; //get the di's and dah's from the alphabet_strings.

String alphabet[] = {
  "300003",   //nothing (void)
  "123003",   //a
  "211133",   //b
  "212133",   //c
  "211303",   //d
  "130003",   //e
  "112133",   //f
  "221303",   //g
  "111133",   //h
  "113003",   //i
  "122233",   //j
  "212303",   //k
  "121133",   //l
  "223003",   //m
  "213003",   //n
  "222303",   //o
  "122133",   //p
  "221233",   //q
  "121303",   //r
  "111303",   //s
  "230003",   //t
  "112303",   //u
  "111233",   //v
  "122303",   //w
  "211233",   //x
  "212233",   //y
  "221133",   //z
  "112211",   //?
};

//char to int ASCII conversion (to make sure it matches up with alphabet[])
#define ASCIIconv 96
//skip if it is this number for it is a space bar
#define space_char 32
#define question_char 63

//String SERVER_URL = "192.168.1.242";

//String SERVER_URL = "192.168.0.103";
//String SERVER_URL = "192.168.0.107";
//String SERVER_URL = "192.168.1.208";
String SERVER_URL = "morsethings.siat.sfu.ca";
//String SERVER_URL = "192.168.1.19";

//int unusedPin = 50;

String NODE_NAME = "b";
int GROUP = 99;

int counter;
const int minProtectionTime = 15000; // 1500 delay * 10 seconds

ESP8266WiFiMulti WiFiMulti;
ESP8266WiFiClass test;

unsigned long prevMillis = 0;

const int sleepTimeS = 10;




void string_to_char() {

  str.toCharArray(charBuf, buffer_length);

  for (int i = 0; i < buffer_length; i++) {
    Serial.print(charBuf[i]);
    Serial.print("\t");
  }
  Serial.println();
  Serial.println();
  delay(100);

}



void char_to_int() {
  //a char to a ASCII = 97 -> a==0

  for (int i = 0; i < buffer_length; i++) {
    intBuf[i] = (int)charBuf[i];
    Serial.print(intBuf[i]);
    Serial.print("\t");
  }
  Serial.println();
  Serial.println();

}


void silence(int i) {
  //wait a while.
  //play a short pulse
 

  digitalWrite(speakerPin, LOW);  //CUP
//  digitalWrite(speakerPin, HIGH);  // BOWL
  delay(bpm*i);
}






void di() {
  //play a short pulse
  
  digitalWrite(speakerPin, HIGH);  // CUP
//  digitalWrite(speakerPin, LOW);  // BOWL
  delay(bpm);
}

void dah() {
  //play a long pulse
  digitalWrite(speakerPin, HIGH);  // CUP
//  digitalWrite(speakerPin, LOW);  // BOWL
  delay(bpm*3);
}



void morse_to_sound(int q) {

  //run through the digits of a character within the morse alphabet
  for (int i = 0; i < character_length; i++) {
    int y;
    alphabet_substr = alphabet[q].substring(i, i + 1);  //get the digit
    y = alphabet_substr.toInt(); //store the digit into an int for comparision.

    /* WHAT y MEANS:
     * 0 = _ (single silence)
     * 1 = di (1 time note)
     * 2 = daaah (3 times the length of di)
     * 3 = end of character (2 times silence)
     * 4 = end of word (3 times silence)
     */

    if (y == 3) {
      //end of the current character
      silence(2);
      break;
    }

    if (y == 1) {
      di();
      silence(1);
    }

    if (y == 2) {
      dah();
      silence(1);
    }

  }
}

void int_to_morse() {

  for (int i = 0; i < buffer_length; i++) {
    //0 is end of the sentence
    if (intBuf[i] == 0) {
      Serial.print(" || ");
      break;
    }
    if (intBuf[i] == space_char) {
      Serial.print(" / ");
      silence(4);
    }
    else if (intBuf[i] == question_char) {
      Serial.print(" ? ");
      morse_to_sound(26);
    }
    else {
      Serial.print(".");
      Serial.print(intBuf[i] - ASCIIconv);
      morse_to_sound((intBuf[i] - ASCIIconv));
    }
  }

}

void talk(String q) {
  str = q;
  string_to_char();
  char_to_int();
  int_to_morse();
}


void setup() {

  didITalked = false;
  counter = 0;
  pinMode(toATtiny, OUTPUT);

  USE_SERIAL.begin(115200);
  // USE_SERIAL.setDebugOutput(true);

  USE_SERIAL.println();
  USE_SERIAL.println();
  USE_SERIAL.println();

  pinMode(BUILTIN_LED, OUTPUT);
  pinMode(speakerPin, OUTPUT);
  digitalWrite(speakerPin, LOW);  // CUP
//  digitalWrite(speakerPin, HIGH); // BOWL

  delay(1000);
  WiFiMulti.addAP("MorseThings", "DesignStudio2016");
  //  WiFiMulti.addAP("Eds-Studio-2ghz", "DesignStudio2015");
  //  WiFiMulti.addAP("MORSE_AP", "morseesp8266");

}

void loop() {


  if ((WiFiMulti.run() == WL_CONNECTED)
      && counter < minProtectionTime && !didITalked)
  {

    prevMillis = millis();
    HTTPClient http;

    USE_SERIAL.print("[HTTP] begin...\n");

    http.begin(SERVER_URL, 80, "/morse_server/checkin.php?node=" + NODE_NAME + "&group=" + GROUP + "&wifi_sig=" + String(test.RSSI())); //HTTP

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
        String fifthValString = payload.substring(forthCommaIndex + 1);
        int fifthValue = fifthValString.toInt();
        USE_SERIAL.println("first: " + firstValue);
        USE_SERIAL.println("secondValue: " + secondValue);
        USE_SERIAL.println("thirdValue: " + thirdValue);
        USE_SERIAL.println("forthValue: " + forthValue);
//        USE_SERIAL.println("fifthValue: " + fifthValue);
        String signal_val = String(test.RSSI());
        USE_SERIAL.println("SIGNAL " + signal_val);
        

        USE_SERIAL.println(payload);

        str = firstValue;
        talk(str);
        didITalked = true;
//        delay(60000 * random(5, 25));
        digitalWrite(toATtiny, HIGH);
      }
    } else {
      USE_SERIAL.print("[HTTP] GET... failed, no connection or no HTTP server\n");
    }
    
  }

  // This give 17-18 seconds
  counter += 1500;

  if (counter > minProtectionTime) {
    USE_SERIAL.println("Counter reset");
    USE_SERIAL.println(counter);
    counter = 0;

    // TODO: no WIFI connection
    talk("sos");
    digitalWrite(toATtiny, HIGH);
  }
  delay(1500);
//  USE_SERIAL.println(random(300));

  
}


