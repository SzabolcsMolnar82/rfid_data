import serial
import mysql.connector

# Soros port megnyitása
ser = serial.Serial('COM3', 9600)  # Cseréld ki a COM portot szükség szerint

# Adatbázis csatlakozás0
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="rfid_data"
)
cursor = db.cursor()

try:
    while True:
        if ser.in_waiting > 0:
            card_id = ser.readline().decode('utf-8').strip()
            sql = "INSERT INTO cards (card_id) VALUES (%s)"
            cursor.execute(sql, (card_id,))
            db.commit()
            print(f"Inserted card ID: {card_id}")

except KeyboardInterrupt:
    print("Leállítás...")
finally:
    ser.close()
    db.close()
