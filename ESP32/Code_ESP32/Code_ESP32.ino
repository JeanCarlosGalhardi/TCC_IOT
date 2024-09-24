// Biblioteca no Sensor
#include "Ultrasonic.h"

// Intervalo entre as leituras
#define INTERVALO 1000

// Definindo os pinos do Sensor
#define PIN_TRIGGER 18
#define PIN_ECHO 19
#define PIN_BUZZER 21

// Variável que armazenará a distância lida pelo Sensor
unsigned int distancia = 0;

// Inicializa o Sensor 
HC_SR04 sensor(PIN_TRIGGER, PIN_ECHO);

void setup() {
  Serial.begin(9600);
  pinMode(PIN_BUZZER, OUTPUT);
  Serial.println("Inicializando dispositivo");
}

void ligarBuzzer(){
  digitalWrite(PIN_BUZZER,HIGH);
}

void desligaBuzzer(){
   digitalWrite(PIN_BUZZER,LOW);
}

void loop() {
distancia = sensor.distance();  

  if (distancia < 5){
    ligarBuzzer();
  } else {
    desligaBuzzer();
  }

  Serial.println(distancia);
  delay(INTERVALO);
}