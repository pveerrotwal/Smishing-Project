#!python3

from distutils.log import error
import telGuarder as tG
import tellows
import mysql.connector
import twitt  
import sys
import os

connection_config_dict = {
        'user': 'root',
        'password': '',
        'host': 'localhost',
        'database': 'smishingDB',
        'raise_on_warnings': True,
        'use_pure': False,
        'autocommit': True,
        'pool_size': 5
}

#mysql server connection, this is locally hosted, put here your values
# ./pyscripts/sql_updater.py 

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="smishingDB"
)   


##########################defining functions to extract informations from the scripts #################

def update_tellows_data():
    mycursor = mydb.cursor()
    sql = "INSERT INTO teldata VALUES ( %s , %s , %s, %s, %s, %s, %s)"  
    df = tellows.extract_data()
    df_list = df.values.tolist()
    values = [(el[0], el[1], el[2], el[3], el[4], el[5], el[6]) for el in df_list]
    mycursor.executemany(sql, values)
    mydb.commit()
    print("Tellows:", mycursor.rowcount, "was inserted.") 


def update_telguarder_data():
    mycursor = mydb.cursor()
    sql = "INSERT IGNORE teldata VALUES ( %s , %s , %s, %s, %s, %s, %s)"  
    df = tG.extract_data()
    df_list = df.values.tolist()
    values = [(el[0], el[1], el[2], el[3], el[4], el[5], el[6]) for el in df_list]
    mycursor.executemany(sql, values)
    mydb.commit()
    print("Telguarder:",mycursor.rowcount, "was inserted.") 

def update_twitter_data(number=10):
    mycursor = mydb.cursor()
    sql = "INSERT IGNORE INTO twittdata VALUES ( %s , %s , %s, %s, %s, %s, %s, %s)" 
    df = twitt.extract_data(number)
    df_list = df.values.tolist()
    #df_list.encode('utf-8')
    values = [(el[0], el[1], el[2], el[3], el[4], el[5], el[6], el[7]) for el in df_list]
    #print(values)
    mycursor.executemany(sql, values)
    mydb.commit()
    print("Twitter:",mycursor.rowcount, "was inserted.")   

if __name__ == '__main__':
    print("Updating data...")
    update_tellows_data()
    update_twitter_data(100)
    update_telguarder_data()
    print("Update finished")
    