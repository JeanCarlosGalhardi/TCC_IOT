#include <WiFi.h>
#include <HTTPClient.h>

const char* ssid = "SEU_SSID";
const char* password = "SUA_SENHA";
const char* serverUrl = "http://<IP_DO_SEU_SERVIDOR>/api.php";

void setup() {
    Serial.begin(115200);
    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
        delay(1000);
        Serial.println("Conectando ao WiFi...");
    }
    Serial.println("Conectado ao WiFi!");
}

void loop() {
    if (WiFi.status() == WL_CONNECTED) {
        HTTPClient http;
        http.begin(serverUrl);

        int httpResponseCode = http.GET();

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
    delay(10000); // Faz uma requisição a cada 10 segundos
}