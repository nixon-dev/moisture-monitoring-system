#include <WiFi.h> //This is the ESP for Bed 1
#include <Wire.h>
#include <HTTPClient.h>
#define MAX_CONNECTION_RETRIES 10

String bedname = "1";                                           // Change the bed number to determine the recipient of the data.
String addlogurl = "http://gravest-departures.000webhostapp.com/includes/add_logs.php"; // This is the URL where the add_logs.php is located, add_logs.php is where we send the value of gauge percentage to be added to the database.
const char *ssid = "prietofamily";                              // Wifi name
const char *wifiPassword = "PrietoFamily2134!!";                // Wifi Password

const int maxGaugeValue = 4092;     // Maximum value of the gauge (change if different)
const int maxGaugePercentage = 100; // Maximum percentage of the gauge (don't change)
const int threshold = 40;           // Threshold when a certain gauge percentage is lower than this the watering system will on
const int relay1Pin = 23;
const int relay2Pin = 25;
const int relay3Pin = 26;
const int g1Pin = 33;
const int g2Pin = 34;
const int g3Pin = 35;
// Don't change anything below, if something is wrong be sure to contact the one who made this, which is me, but please don't.

void setup()
{
  Serial.begin(115200);
  connectWifi();
  pinMode(relay1Pin, OUTPUT);
  pinMode(relay2Pin, OUTPUT);
  pinMode(relay3Pin, OUTPUT);
}

void loop()
{
  serialMon();
  const int gauge1 = analogRead(g1Pin);                                        // This is where raw gauge1 value is stored
  const int gauge2 = analogRead(g2Pin);                                        // This is where raw gauge2 value is stored
  const int gauge3 = analogRead(g3Pin);                                        // This is where raw gauge3 value is stored
  int gauge1Percentage = map(gauge1, 0, maxGaugeValue, maxGaugePercentage, 0); // Converts the value raw value of gauge1 into percentage
  int gauge2Percentage = map(gauge2, 0, maxGaugeValue, maxGaugePercentage, 0); // Converts the value raw value of gauge2 into percentage
  int gauge3Percentage = map(gauge3, 0, maxGaugeValue, maxGaugePercentage, 0); // Converts the value raw value of gauge3 into percentage
  // Example: Sending data of the gauges to the server(add_logs.php)
  String postData = "bedname=" + String(bedname) + "&" +
                    "gauge1=" + String(gauge1Percentage) + "&" +
                    "gauge2=" + String(gauge2Percentage) + "&" +
                    "gauge3=" + String(gauge3Percentage);
  // Send the data to the server using the appropriate method (e.g., HTTP POST)
  WiFiClient client;
  HTTPClient http;
  http.begin(client, addlogurl);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  int httpCode = http.POST(postData);
  String payload = http.getString();
  Serial.print("URL: ");
  Serial.println(addlogurl);
  Serial.print("Data: ");
  Serial.println(postData);
  Serial.print("HTTP Code: ");
  Serial.println(httpCode);
  Serial.print("Response: ");
  Serial.println(payload);
  // Check if AWS is On
  if (payload.indexOf("Manual Switch: On") != -1)
  {
    digitalWrite(relay1Pin, LOW); // Turn on relay 1
    digitalWrite(relay2Pin, LOW); // Turn on relay 2
    digitalWrite(relay3Pin, LOW); // Turn on relay 3
    Serial.print("Manual Switch: Relays are ON");
  }
  else
  {
    if (payload.indexOf("AWS: On") != -1)
    {
      // Gauge 1 Automated Watering System Condition if "AWS: On" is found in the payload
      if (gauge1Percentage < threshold)
      {
        digitalWrite(relay1Pin, LOW); // Turn on relay 1
        Serial.println("Relay 1 is ON");
      }
      else
      {
        digitalWrite(relay1Pin, HIGH); // Turn off relay 1
        Serial.println("Relay 1 is OFF");
      }
      // Gauge 2 Automated Watering System Condition if "AWS: On" is found in the payload
      if (gauge2Percentage < threshold)
      {
        digitalWrite(relay2Pin, LOW); // Turn on relay 2
        Serial.println("Relay 2 is ON");
      }
      else
      {
        digitalWrite(relay2Pin, HIGH); // Turn off relay 2
        Serial.println("Relay 2 is OFF");
      }
      // Gauge 3 Automated Watering System Condition if "AWS: On" is found in the payload
      if (gauge3Percentage <= threshold)
      {
        digitalWrite(relay3Pin, LOW); // Turn on relay 3
        Serial.println("Relay 3 is ON");
      }
      else
      {
        digitalWrite(relay3Pin, HIGH); // Turn off relay 3
        Serial.println("Relay 3 is OFF");
      }
    }
    // Turns off the Automated Watering System if "AWS: On" is not found
    else
    {
      digitalWrite(relay1Pin, HIGH); // Turn off relay 1
      digitalWrite(relay2Pin, HIGH); // Turn off relay 2
      digitalWrite(relay3Pin, HIGH); // Turn off relay 3
      Serial.print("Relays are OFFs");
    }
  }
  http.end();

  delay(5000); // Delay for 5 minutes before the next iteration 300000
}

void serialMon()
{
  if (Serial.available())
  {
    char receivedChar = Serial.read();
    Serial.print("Received: ");
    Serial.println(receivedChar);
  }
}

void connectOpenWifi()
{
  WiFi.disconnect();
  WiFi.mode(WIFI_STA);

  int networkCount = WiFi.scanNetworks();
  if (networkCount == 0)
  {
    Serial.println("No open networks found.");
    return;
  }

  for (int i = 0; i < networkCount; ++i)
  {
    if (WiFi.encryptionType(i) == WIFI_AUTH_OPEN)
    {
      String openSsid = WiFi.SSID(i);
      Serial.print("Connecting to open network: ");
      Serial.println(openSsid);

      WiFi.begin(openSsid.c_str());

      while (WiFi.status() != WL_CONNECTED)
      {
        delay(1000);
        Serial.print(".");
      }

      Serial.println();
      Serial.println("Connected to open WiFi");
      Serial.print("IP address: ");
      Serial.println(WiFi.localIP());

      return;
    }
  }

  Serial.println("No open networks found to connect to.");
}

void connectWifi()
{
  int retries = 0;

  while (retries < MAX_CONNECTION_RETRIES)
  {
    WiFi.begin(ssid, wifiPassword);

    while (WiFi.status() != WL_CONNECTED)
    {
      delay(1000);
      Serial.print("Connecting to WiFi... Retries: ");
      Serial.println(retries);

      retries++; // Increment retries inside the inner loop

      if (retries >= MAX_CONNECTION_RETRIES)
      {
        connectOpenWifi();
      }
    }

    if (WiFi.status() == WL_CONNECTED)
    {
      Serial.println("Connected to WiFi");
      return;
    }
  }

  Serial.println("Failed to connect to WiFi. Switching to open WiFi...");
  connectOpenWifi();
}
