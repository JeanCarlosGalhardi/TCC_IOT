// Biblioteca no Sensor
#include "Ultrasonic.h"
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>
const char* ssid = "Galhardi";
const char* password = "G@lh@rd1";
const char* serverUrl = "http://192.168.3.6/Web/insert.php";

// Intervalo entre as leituras
#define INTERVALO 5000
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
  WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
        delay(1000);
        Serial.println("Conectando ao WiFi...");
    }
    Serial.println("Conectado ao WiFi!");
}

void ligarBuzzer(){
  digitalWrite(PIN_BUZZER,HIGH);
}

void desligaBuzzer(){
   digitalWrite(PIN_BUZZER,LOW);
}

void enviaDados(int distancia){
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(serverUrl);

    // Criação do JSON
    StaticJsonDocument<200> jsonDoc;
    jsonDoc["id_sensor"] = 1; // Enviar como número
    jsonDoc["valor"] = distancia; // Enviar como número

    String jsonString;
    serializeJson(jsonDoc, jsonString);

    // Configura a requisição como POST
    http.addHeader("Content-Type", "application/json");
    int httpResponseCode = http.POST(jsonString);

    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println("Resposta do servidor: " + response);
    } else {
      Serial.println("Erro ao fazer a requisição: " + String(httpResponseCode));
    }
    http.end();
    } else {
        Serial.println("WiFi desconectado");
    }
}

void loop() {
distancia = sensor.distance();  

  if (distancia < 5 and distancia > 0){
    ligarBuzzer();
  } else {
    desligaBuzzer();
  }
  
  Serial.println(distancia);
  if (distancia > 0) {
    enviaDados(distancia);
    delay(INTERVALO);
  }
 
}