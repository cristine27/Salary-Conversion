IoT Application Developer (R&D) Tech Test Problem Documentation 
By : Cristine Artanty

Environment : 
Framework : CodeIgniter 4 + FrontEnd (Bootstrap)
Port : Localhost:8080 
Design : Model-View-Controller

Run :
Download the file from my github 
Open commend line in the SalaryConversion folder and type : php spark serve
Open browser : http://localhost:8080/

Introduction 
I develop one project to solve 3 problem in the code-test. Home is used to navigate between the problem solution. 
 
There’s 3 button that used to navigate each problem
-	Salary converstion : problem 1
-	Sensors Aggregation : problem 2
-	Sensors Aggregation Simulation : problem 3

Folder Structure :
-	App
  o	Controller ( BaseController.php, Home.php, Salary.php, Sensor.php )
  o	Models ( sensorModel.php )
  o	Views
    	pages ( home_page.php, salary_page.php, sensor_agre.php )
    	layout ( template.php )
-	Public 
    o	Chartjs ( Chart.bundle.min )
    o	Json ( salary_data.json, sensor_data.json )
    o	Style.css
    o	New_SensingData.json

Problem 1 : Salary Conversion 
Controller -> Salary.php
View -> salary_page.php

Solution : 
-	Request from currency converter api and save the value in a variable so we don’t make too many request on the API
-	Get the json file from the given URL and read salary data from file
-	Fetch the data and join by id using for, calculate the salary in USD and send the data to view

Problem 2 : Sensor Aggregation
Controller -> Sensor.php
View -> sensor_agre.php

Solution : 
-	Make some variable to save some data that used in both problem 2 and 3, in the contructor initiate the variable and read the given json file.
-	In method convert_data,
o	Used to filter and divide temperature and humidity value for room1, room2, and room3.
o	Save all the data in the variable
o	Calculate min, max, average, and median for each room data both temperature and humidity.
-	Send all the data to view, in view file each data is used to build a chart object.

Problem 3 : Sensor Aggregation Simulation
Controller -> Sensor.php
View -> sensor_agre.php

Solution : 
-	Same with problem 2, but in the view used a button to trigger a simulation
-	In sensing method, If the button triggered will call a method ( start_sense() ) to random value and save the each value to a json and write it to json file.
-	The json file will be put in public folder ( New_SensingData.json ).

IDEAS OR CONSIDERATION : 
1.	This project is only using 1 port ( localhost:8080 ) because codeigniter4 framework that I used to built this project already include frontend and backend. 
2.	for sensor problem, the data can be stored at database. So we can make a sensor model in the project that can be used to query the data. For example if we want to get room1 data we could query all the data where the roomArea is roomArea1. If db is used to solve the problem will be much effective because we don’t need to fetch the data with looping.
