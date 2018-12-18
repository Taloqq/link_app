# Gets and pastes corresponding values from json file to paste.txt

import json
import sys
import io

data_path = 'ci/json/paikkakunnat.json'
with open(data_path) as file:
    data = (json.load(file))
file.close()

# Declare which value you want to get
key = "KUNTANIMIFI"

itemList = []
for item in data:
    itemList.append(item[key])
listLen = len(itemList)

with io.open("paste.txt", 'w', encoding="utf-8") as file:
    x = 0
    for item in data:
        while x < listLen - 1:
            comma = ", "
            break
        else:
            comma = ""
        x += 1
        file.write("'" + item[key] + "'" + comma)
file.close()
