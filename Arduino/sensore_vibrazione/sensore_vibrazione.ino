#define VIBRATION_SENSOR_PIN A0
 
int motion_detected = 0;
 
void setup() {
  Serial.begin(115200);
  pinMode(VIBRATION_SENSOR_PIN, INPUT); 
}
 
void loop() {
  motion_detected = analogRead(VIBRATION_SENSOR_PIN);
  Serial.println(motion_detected);
  delay(100);
}
