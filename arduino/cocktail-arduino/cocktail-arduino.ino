#define numberOfLiquors 7
#define latchPin 5
#define clockPin 6
#define dataPin 4
#define pumpPin 7
String drinkCode;   // for incoming serial data
char liquorIndicator[] = {'A','B','C','D','E','F','G'};//easier like this because number of drinks can easily be extended
long timeLiquor[numberOfLiquors];//saves the times of each liquor
int amountIngredients;//represents the amount of ingredients
int ingredientsAdded;//represents the amount of ingredients already added
byte data;//represents data sent to shift register

void setup() {
  pinMode(latchPin, OUTPUT);
  pinMode(clockPin, OUTPUT);
  pinMode(dataPin, OUTPUT);
  Serial.begin(9600);
  pinMode(pumpPin,OUTPUT);
}

void loop() {
  if (Serial.available() > 0) {
    drinkCode = Serial.readStringUntil(';'); // read the incoming byte:
    Serial.readString();  //clears the remaining serial buffer after the ';'
    Serial.print("input: ");
    Serial.println(drinkCode); //Sends a return to Rpi  
    amountIngredients = 0;
    for (int x = 0; x < 10; x++) { //ten ingredients limit
      for(int y = 0; y < numberOfLiquors; y++){
        if (drinkCode[x*4] == liquorIndicator[y])
          amountIngredients++;    
      }
    }
    Serial.println("The amount of ingredients for this mix: " + String(amountIngredients));
    ingredientsAdded = 0;
    digitalWrite(pumpPin,1);
    while(ingredientsAdded < amountIngredients) {//check for each ingredient and for each liquor what quantity should be in the mix
      int i = ingredientsAdded*4;
      for(int y = 0; y < numberOfLiquors; y++){
        if(drinkCode[i] == liquorIndicator[y])
        {
          timeLiquor[y] = 100*long((drinkCode[i+1]-48)*100 + (drinkCode[i+2]-48)*10 + drinkCode[i+3]-48);
          Serial.println("time liquor " + String(liquorIndicator[y]) + ": " + String(timeLiquor[y]) + " milliSeconds");
          fillLiquor(timeLiquor[y],y+1);
        }
      }
      ingredientsAdded++;
    }
    digitalWrite(pumpPin,0);
    Serial.print("Done!");
  }
}

void fillLiquor(long thisTime, int bottleNr)//left bottle to right bottle 1 is leftmost liquor bottle 7 is rightmost liquor bottle 0 is for the air valve, controlled in another function
{
  bitSet(data,bottleNr);
  shiftOut(dataPin, clockPin, data);
  while(thisTime > 10000)//arduino delay() can't get higher than around 16000, therefore this while loop is necessary
  {
   delay(10000);
   thisTime = thisTime - 10000;
  }
  delay(thisTime);
  shiftOut(dataPin, clockPin, 0);
}
void emptyBottle(int bottleNr)//Empties bottle to close first valve with air and at the same time valve with bottle to choice
{
  data = 2+1<<bottleNr;//data = 1 + 1<<bottleNr;
  shiftOut(dataPin, clockPin, data);
  delay(10000);
}
void shiftOut(int myDataPin, int myClockPin, byte myDataOut) {//shifts data to shift register in order to control valves
  digitalWrite(latchPin, 0);
  digitalWrite(myDataPin, 0);
  digitalWrite(myClockPin, 0);
  for (int i=7; i>=0; i--)  {
    digitalWrite(myClockPin, 0);
    if ( myDataOut & (1<<i) ) {
      digitalWrite(myDataPin, 1);
    }
    else {  
      digitalWrite(myDataPin, 0);
    }
    digitalWrite(myClockPin, 1);
    digitalWrite(myDataPin, 0);
  }
  digitalWrite(myClockPin, 0);
  digitalWrite(latchPin, 1);
}
