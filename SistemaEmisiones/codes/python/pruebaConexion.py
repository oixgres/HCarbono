# -*- coding: utf-8 -*-
"""
Created on Thu Aug 26 23:16:49 2021

@author: Sergio
"""
import requests
import random

values = {
  'id':1,
  'vLat':random.randrange(1,100),
  'vLon':random.randrange(1,100),
  'vTem':random.randrange(1,100),
  'vPres':random.randrange(1,100), 
  'v02':random.randrange(1,100), 
  'vH2':random.randrange(1,100),
  'vCO':random.randrange(1,100),
  'vCO2':random.randrange(1,100)
}

res = requests.post('http://hcarbono.com/codes/php/datos.php',headers={"User-Agent": "XY"}, data=values)
print(res.json()['prueba'])
