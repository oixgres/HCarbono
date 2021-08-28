# -*- coding: utf-8 -*-
"""
Created on Thu Aug 26 23:16:49 2021

@author: Sergio
"""
import requests

values = {'id':1, 'vLat':10, 'vLon':10, 'vTem':10,'vPres':10, 'v02':10, 'vH2':10,'vCO':10,'vCO2':10}

res = requests.post('http://hcarbono.com/codes/php/datos.php',headers={"User-Agent": "XY"}, data=values)
print(res.json()['prueba'])
