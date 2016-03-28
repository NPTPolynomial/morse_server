#include <avr/sleep.h> //Needed for sleep_mode
#include <avr/wdt.h> //Needed to enable/disable watch dog timer

volatile int watchdog_counter;
int vccPin = 7; // gate pin
int signalPin = 5; // if pin recieve high from an external source it will activate sleep mode

//This runs each time the watch dog wakes us up from sleep
ISR(WDT_vect) {
  watchdog_counter++;
}

void setup() {
  // put your setup code here, to run once:
  watchdog_counter = 0;
  pinMode(vccPin, OUTPUT); // initialize vcc pin for mosfet
  pinMode(signalPin, INPUT);// initialize singalPin for taking in signal from a source

  //Power down various bits of hardware to lower power usage  
  set_sleep_mode(SLEEP_MODE_PWR_DOWN); //Power down everything, wake up from WDT
  sleep_enable();
  ADCSRA &= ~(1<<ADEN); //Disable ADC, saves ~230uA
  
  setup_watchdog(3); //Wake up after 128 msec

}

void loop() {
  // put your main code here, to run repeatedly:
  
  ADCSRA |= (1<<ADEN); //Enable ADC
  
    watchdog_counter = 0;
    wdt_disable(); //Turn off the WDT!!
    digitalWrite(vccPin, HIGH);
    
    long startTime = millis(); //Record the current time
    long timeSinceBlink = millis(); //Record the current time for blinking
    
    //Loop 20 seconds of have completed
    while((millis() - startTime) < 100){
      digitalWrite(vccPin, HIGH);
    }
    
    //wdt_enable(WDTO_4S);
    
  
  if(digitalRead(signalPin) == HIGH)
  {
    for(int i =0; i < random(60,300); i++){
    ADCSRA &= ~(1<<ADEN); //Disable ADC, saves ~230uA
    setup_watchdog(6); //Setup watchdog to go off after 1sec
    sleep_mode(); //Go to sleep! Wake up 1sec later and check water
    digitalWrite(vccPin, LOW);
    }
  }

}


// 0=16ms, 1=32ms, 2=64ms, 3=128ms, 4=250ms, 5=500ms
// 6=1sec, 7=2sec, 8=4sec, 9=8sec
// From: http://interface.khm.de/index.php/lab/experiments/sleep_watchdog_battery/
void setup_watchdog(int timerPrescaler) {

  if (timerPrescaler > 9 ) timerPrescaler = 9; //Correct incoming amount if need be

  byte bb = timerPrescaler & 7; 
  if (timerPrescaler > 7) bb |= (1<<5); //Set the special 5th bit if necessary

  //This order of commands is important and cannot be combined
  MCUSR &= ~(1<<WDRF); //Clear the watch dog reset
  WDTCSR |= (1<<WDCE) | (1<<WDE); //Set WD_change enable, set WD enable
  WDTCSR = bb; //Set new watchdog timeout value
  WDTCSR |= _BV(WDIE); //Set the interrupt enable, this will keep unit from resetting after each int
}
