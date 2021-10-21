#ifdef F_CPU
#define SYSCLOCK F_CPU // main Arduino clock
#else
#define SYSCLOCK 16000000 // main Arduino clock
#endif


#define TIMER_CONFIG_KHZ(val)
#define TIMER_PWM_PIN 3//3

void mark(int time) {
 // Sends an IR mark for the specified number of microseconds.
 // The mark output is modulated at the PWM frequency.
 TIMER_ENABLE_PWM; // Enable pin 3 PWM output
 if (time > 0) delayMicroseconds(time);
}

/* Leave pin off for time (given in microseconds) */
void space(int time) {
 // Sends an IR space for the specified number of microseconds.
 // A space is no output, so the PWM output is disabled.
 TIMER_DISABLE_PWM; // Disable pin 3 PWM output
 if (time > 0) delayMicroseconds(time);
}

void setup() {
 TIMSK2 = 0; // Disable the Timer2 Interrupt
 
 pinMode(TIMER_PWM_PIN, OUTPUT);
 digitalWrite(TIMER_PWM_PIN, LOW); // When not sending PWM, we want it low
 
 // COM2A = 00: disconnect OC2A
 // COM2B = 00: disconnect OC2B; to send signal set to 10: OC2B non-inverted
 // WGM2 = 101: phase-correct PWM with OCRA as top
 // CS2 = 000: no prescaling
 // The top value for the timer. The modulation frequency will be SYSCLOCK / 2 / OCR2A.
 TIMER_CONFIG_KHZ(38);
}

void sendData(byte val, int bits=8) {
 for(int i=0; i<bits; i++) {
 int on = val & (1 << (bits-1-i));
 if (on)
 mark(819);
 else
 space(819);
 }
}

void loop() {
 sendData(0xFF);
 sendData(0x1E);
 sendData(0x53);
 sendData(0x4A); // data
 sendData(0x6C); // data
 sendData(0xC0);
 delay(40000000);
}
