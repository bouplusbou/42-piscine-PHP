import json

with open('data.json') as f:
	data = json.load(f)
	
for element in data['elements']:
	print ('<li id="' + str(element['symbol']) + '" class="element ' + str(element['groupBlock']).replace(" ", "_") + '">')
	print ('<h2>' + str(element['symbol']) + '</h2>')
	print ('<p class="nb">' + str(element['atomicNumber']) + '</p>')
	print ('<p class="mass">' + str(element['atomicMass'])[0:5] + '</p>')
	print ('</li>')
	# print ('#' + str(element['symbol']) + '{grid-column:1; grid-row:1;}')

