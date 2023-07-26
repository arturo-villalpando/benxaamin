# benxaamin
Benxaamin

## Notes
Faltan muchas mejoras:

- Terminar el actualizar un empleado.
- Hacer los endpoint de la tabla relacionar, para hacer una relación sin necesidad de editar toda la info del usuario.
- Mejorar la validación de errores que se tiene que regresar.
- Y las solicitadas por la prueba.

# Run
./vendor/bin/sail 

# Migrate 
./vendor/bin/sail artisan migrate:fresh --seed

Algunas veces el seed truena ya que no se puso que validara que generará datos únicos

# Postman

## Usuario
Generar api key con los siguientes datos (Post -> body -> form-data):

POST: http://localhost:8000/api/login
email: test@example.com
password: demo123

## Creare Employee
Generar usuario con (Post -> body -> form-data):

POST: http://localhost:8000/api/employee

"name": "Arturo",
"email": "arturo.villalpando@gmail.com",
"position": "CEO",
"birthday": "20/10/1985",
"address": "Tauro 128",
"address2": "Villas del sol",
"city": "Zacatecas",
"country": "Mexico",
"cp": "98067"
"skills": "[{ "Futball": 5 },{ "Basketball": 5 }]"

## List employees
GET: http://localhost:8000/api/employee

GET: http://localhost:8000/api/employee/{id}