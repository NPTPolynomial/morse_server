// this sketch is intented to test N channcel power mosfet. This sketch will turn on
//watch dog timer (WDT). Attiny84 will be used to  to turn on or off the
#include <avr/sleep.h>
#include <avr/wdt.h>

int vccPin = 6; // gate pin
int signalPin = 5; // if pin recieve high from an external source it will activate sleep mode
int val = 0;

volatile int watchdog_counter;

ISR(WDT_vect) {
  watchdog_counter++;
}

void setup() {
  // put your setup code here, to run once:
  pinMode(vccPin, OUTPUT); // initialize vcc pin for mosfet
  pinMode(signalPin, INPUT);// initialize singalPin for taking in signal from a source
  
  pinMode(7, OUTPUT);
  //  digitalWrite(vccPin, LOW);
  digitalWrite(vccPin, HIGH);
  //Power down various bits of hardware to lower power usage
  watchdog_counter = 0;

  ADCSRA &= ~(1 << ADEN); //Disable ADC, saves ~230uA
  set_sleep_mode(SLEEP_MODE_PWR_DOWN); //Power down everything, wake up from WDT
  sleep_enable();
}

void loop() {


  if (watchdog_counter > 2 )  //88
  {
    digitalWrite(vccPin, HIGH);
    wdt_disable();  // turn off watchdog timer
    watchdog_counter = 0; // reset counter
  }
  val = digitalRead(signalPin);
  if (val == HIGH) {
//    digitalWrite(7, HIGH);
//    delay(2000);
//    digitalWrite(7, LOW);
//    delay(2000);
    digitalWrite(vccPin, LOW);
    
    setup_watchdog(7);
    

    sleep_mode(); //Go to sleep! MODE
  } else {
    digitalWrite(vccPin, HIGH);
  }
  //  if (val == HIGH) {
  //    digitalWrite(vccPin, LOW);
  //    sleepForSeco(8);
  //    digitalWrite(vccPin, HIGH);
  //    delay(10000);
  //  }

  delay(10);


}


// 0=16ms, 1=32ms, 2=64ms, 3=128ms, 4=250ms, 5=500ms
// 6=1sec, 7=2sec, 8=4sec, 9=8sec
// From: http://interface.khm.de/index.php/lab/experiments/sleep_watchdog_battery/
void setup_watchdog(int timerPrescaler) {

  if (timerPrescaler > 9 ) timerPrescaler = 9; //Correct incoming amount if need be

  byte bb = timerPrescaler & 7;
  if (timerPrescaler > 7) bb |= (1 << 5); //Set the special 5th bit if necessary

  //This order of commands is important and cannot be combined
  MCUSR &= ~(1 << WDRF); //Clear the watch dog reset
  WDTCSR |= (1 << WDCE) | (1 << WDE); //Set WD_change enable, set WD enable
  WDTCSR = bb; //Set new watchdog timeout value
  WDTCSR |= _BV(WDIE); //Set the interrupt enable, this will keep unit from resetting after each int
}
