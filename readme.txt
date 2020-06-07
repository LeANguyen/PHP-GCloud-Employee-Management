Le An Nguyen - s3651589

Assignment1 - Cloud Computing

App url: https://cloudnguyen1.appspot.com

Summarise:

The app is developed using PHP. Front end is developed using HTML, CSS, AJAX data table and Bootstrap

Task1: CRUD, Search and Filter
- CRUD features include Create, Update and Delete employees. 
- Employees data is saved in a employees.csv file. 
- The csv file is stored on Google Cloud Storage -> at (bucket: cloud-a1) of (project: cloudnguyen1) 
- Any CRUD action is done directly on the file through the link: gs://cloud-a1/employees.csv...by using fwrite
- Search, Filter and pagination is already implemented in AJAX data table framework

Task2: Frequency
- There is a separate page to see firstname and lastname frequency

- A csv file baby_names.csv is stored on Google Big Query database

- By querying the dataset using Google Big Query api, we can see the frequency of employee name compared to baby_names.csv


