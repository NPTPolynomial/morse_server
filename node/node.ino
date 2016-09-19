#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <string.h>

#include "Morse_sound_library.h"
#include "Morse_battery_level.h"

#define USE_SERIAL Serial


String SERVER_URL = "morsethings.siat.sfu.ca";
String NODE_NAME = "b";
int GROUP = 99;
int toATtiny = 12;


boolean didITalked = false;
int counter;
const int minProtectionTime = 15000; // 1500 delay * 10 seconds
unsigned long prevMillis = 0;
const int sleepTimeS = 10;


ESP8266WiFiMulti WiFiMulti;
ESP8266WiFiClass test;





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

  prevMillis = millis();

}

void loop() {


  if ((WiFiMulti.run() == WL_CONNECTED) && !didITalked)
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
        digitalWrite(toATtiny, HIGH);
      }
      
    } else {
      USE_SERIAL.print("[HTTP] GET... failed, no connection or no HTTP server\n");
    }
    
  } else {
  
    if (millis() - prevMillis > minProtectionTime) {
      prevMillis = millis();
      // No WIFI connection
      if(!didITalked){
        talk("sos");
        didITalked = true;
      }
      digitalWrite(toATtiny, HIGH);
    }
    
  }

  battery_level();








//end of loop()
}

