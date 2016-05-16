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

String SERVER_URL = "192.168.0.103";
//String SERVER_URL = "192.168.1.208";

//String SERVER_URL = "192.168.1.19";
String SERVER_PAGE = "/morse_server/";

//int unusedPin = 50;

String NODE_NAME = "a";
String NETWORK = "1";
const int NUM_NODES = 2;
String ALL_NODES[] = {"a", "b"};

int counter;
const int minProtectionTime = 15000; // 1500 delay * 10 seconds

ESP8266WiFiMulti WiFiMulti;
ESP8266WiFiClass test;

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

  delay(1000);
  WiFiMulti.addAP("eds2g", "DesignStudio2016");
  //  WiFiMulti.addAP("Eds-Studio-2ghz", "DesignStudio2015");
  //  WiFiMulti.addAP("MORSE_AP", "morseesp8266");

}

void loop() {

  USE_SERIAL.println(test.SSID());
  USE_SERIAL.println(test.RSSI());

  if ((WiFiMulti.run() == WL_CONNECTED)
      && counter < minProtectionTime)
  {

    prevMillis = millis();
    HTTPClient http;

    USE_SERIAL.print("[HTTP] begin...\n");

    http.begin(SERVER_URL, 80, "/morse_server/checkin.php?node=" + NODE_NAME); //HTTP

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
        USE_SERIAL.println("fifthValue: " + fifthValue);

        USE_SERIAL.println(payload);
      }
    } else {
      USE_SERIAL.print("[HTTP] GET... failed, no connection or no HTTP server\n");
    }
  }

  counter += 1500;

  if (counter > minProtectionTime) {
    USE_SERIAL.println("Counter reset");
    USE_SERIAL.println(counter);
    counter = 0;
    USE_SERIAL.println(counter);
  }
  delay(1500);
}
