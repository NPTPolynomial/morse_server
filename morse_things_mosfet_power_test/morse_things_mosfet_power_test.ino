// this sketch is intented to test N channcel power mosfet. This sketch will turn on
//watch dog timer (WDT). Attiny84 will be used to  to turn on or off the
#include <avr/sleep.h>
#include <avr/wdt.h>

// 2 3 4 5 pwn
// 0 1 6 7 8 9 10

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
  digitalWrite(vccPin, LOW);
  watchdog_counter = 0;

  //Power down various bits of hardware to lower power usage

  ADCSRA &= ~(1 << ADEN); //Disable ADC, saves ~230uA
  set_sleep_mode(SLEEP_MODE_PWR_DOWN); //Power down everything, wake up from WDT
  sleep_enable();
}

void loop() {


  val = digitalRead(signalPin);
  while (val == LOW) {
    val = digitalRead(signalPin);
  }

  setup_watchdog(9);

  sleep_mode(); //Go to sleep! MODE

  if (watchdog_counter > 1 )  //88
  {
    wdt_disable();  // turn off watchdog timer
    watchdog_counter = 0; // reset counter

  }

  delay(10);


}



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

