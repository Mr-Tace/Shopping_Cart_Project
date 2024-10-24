#include <SPI.h>
#include <WiFiS3.h>
#include <RFID.h>

#include "config.h" //Private Network Information

#define SS_kar_PIN 10
#define RST_kar_PIN 9

RFID rfid_kar(SS_kar_PIN, RST_kar_PIN);

String rfidCard;
String phonecheck;
String query;

const int CartID = 1;
bool Cart_AD = 1; //If False Removes the Next RFID Tag

char ssid[] = WIFI_SSID;        // your network SSID (name)
char pass[] = WIFI_PASSWORD;
int status = WL_IDLE_STATUS;      // the WiFi radio's status

char server[] = Server_IP;  //Location of the Database and Apache Server

WiFiClient client;



void setup() {
  Serial.begin(9600);
  Serial.println("");

  Serial.println("Starting RFID Reader...");

  WiFi_Connect();

  Serial.println("<<<Waiting for RFID TAG>>>");
  Serial.println();

  SPI.begin();
  rfid_kar.init();
}

void loop() {
  
  if (rfid_kar.isCard()) {
    if (rfid_kar.readCardSerial()) {
      
      phonecheck = String(rfid_kar.serNum[0]);
      rfidCard = String(rfid_kar.serNum[0]) + String(rfid_kar.serNum[1]) + String(rfid_kar.serNum[2]) + String(rfid_kar.serNum[3]);
      
      if (phonecheck == "8"){
        Serial.println("");
        Serial.println("This is a phone");
        Serial.print("Cart ID is ");
        Serial.println(CartID);
      }
      else{
        Serial.println("<<<RFID Found>>>");
    
        Serial.print("RFID: " );
        Serial.println(rfidCard);
        query = String("product_id=" + rfidCard + "&cart_id=" + CartID);
        Serial.print("Query: ");
        Serial.println(query);

        write_db();

        Serial.println();
        delay(500);
      }
        
      }
    }
    rfid_kar.halt();
}



void WiFi_Connect() {

  if (WiFi.status() == WL_NO_MODULE) {

    Serial.println("Communication with WiFi module failed!");

    // don't continue

    while (true);

  }

  // attempt to connect to WiFi network:

  while (status != WL_CONNECTED) {

    Serial.print("Attempting to connect to WPA SSID: ");
    Serial.println(ssid);
    status = WiFi.begin(ssid, pass); // Connect to WPA/WPA2 network:
    
    delay(1000);
  }

  IPAddress ip = WiFi.localIP();
  Serial.print("You're connected, IP Address: ");
  Serial.println(ip);
  Serial.println();
}

void write_db() {
  
  if(client.connect(server, 80)){
    if(Cart_AD == 1){client.println("POST /Build/PHP_Server/ard_con_sql.php HTTP/1.1");}
    else if(Cart_AD == 0){client.println("POST /Build/PHP_Server/ard_del_sql.php HTTP/1.1");}
    client.print("Host: ");
    client.println(server);
    client.println("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
    client.print("Content-Length: ");
    client.println(query.length());
    client.println();
    client.print(query);
    client.println("Connection: close");
    client.stop();
    Serial.println("Database updated");
  }
  else{
    Serial.println("Failed to connect to Server");
  }

}


