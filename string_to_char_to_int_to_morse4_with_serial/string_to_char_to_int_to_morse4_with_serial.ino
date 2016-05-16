String str = "hi guys";
#define buffer_length 30
char charBuf[buffer_length];
int intBuf[buffer_length];

//set the speakerpin and tonal qualities of our morse-sounds
#define speakerPin 10
#define pitch 440
#define bpm 100
///long bpmdelay = 0;

//Within international morse code the maximum length of a character is 5 'notes'
//The last note of a character is a stop symbol -> therefore length + 1
#define character_length 6
String alphabet_substr; //get the di's and dah's from the alphabet_strings.

/*
 * 0 = _ (single silence)
 * 1 = di (1 time note)
 * 2 = daaah (3 times the length of di)
 * 3 = end of character (2 times silence)
 * 4 = end of word (3 times silence) 
 */

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
};

//char to int ASCII conversion (to make sure it matches up with alphabet[])
#define ASCIIconv 96
//skip if it is this number for it is a space bar
#define space_char 32



void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  delay(2000);

  string_to_char();
  char_to_int();
  int_to_morse();
  //turn off again
}

void loop() {
  // put your main code here, to run repeatedly:
  if (Serial.available() > 0) {
    str = Serial.readString();
    string_to_char();
    char_to_int();
    int_to_morse();
  }
}

void string_to_char() {

  str.toCharArray(charBuf, buffer_length);

  for (int i = 0; i < buffer_length; i++) {
    Serial.print(charBuf[i]);
    Serial.print("\t");
  }
  Serial.println();
  Serial.println();
  //delay(100);

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



void int_to_morse() {

  for (int i = 0; i < buffer_length; i++) {
    //0 is end of the sentence
    if (intBuf[i] == 0 || intBuf[i] == 10) {
      Serial.print(" || ");
      break;
    }
    if (intBuf[i] == space_char) {
      Serial.print(" / ");
      silence(4);
    }
    else {
      Serial.print(".");
      Serial.print(intBuf[i] - ASCIIconv);
      morse_to_sound((intBuf[i] - ASCIIconv));
    }
  }

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


void di() {
  //play a short pulse

  tone(speakerPin, pitch);
  delay(bpm);
}

void dah() {
  //play a long pulse

  tone(speakerPin, pitch);
  delay(bpm * 3);
}

void silence(int i) {
  //wait a while.
  //play a short pulse

  noTone(speakerPin);
  delay(bpm * i);
}

