// this sketch is intented to test N channcel power mosfet. This sketch will turn on
//watch dog timer (WDT). Attiny84 will be used to  to turn on or off the
#include <avr/sleep.h>
#include <avr/wdt.h>

int vccPin = 6; // gate pin
int signalPin = 5; // if pin recieve high from an external source it will activate sleep mode
int val = 0;



void setup() {
  // put your setup code here, to run once:
  pinMode(vccPin, OUTPUT); // initialize vcc pin for mosfet
  pinMode(signalPin, INPUT);// initialize singalPin for taking in signal from a source
  digitalWrite(vccPin, LOW);
  digitalWrite(vccPin, HIGH);
  //Power down various bits of hardware to lower power usage

  ADCSRA &= ~(1 << ADEN); //Disable ADC, saves ~230uA
  set_sleep_mode(SLEEP_MODE_PWR_DOWN); //Power down everything, wake up from WDT
  sleep_enable();
}

void loop() {
  

  val = digitalRead(signalPin);
  if (val == HIGH) {
    digitalWrite(vccPin, LOW);
    sleepForSeco(10);
    digitalWrite(vccPin, HIGH);
    
  }
  delay(10);


}


void sleepForSeco(int numOfSleep){
  for(int i=0; i<numOfSleep; i++){
    sleep_mode();
  }
}

