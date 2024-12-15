# Project: Data Migration to MongoDB

This project migrates data from a structured `.txt` file into a MongoDB database. It uses Laravel and Docker to provide a scalable, containerized solution for handling large data migrations. The application includes an API to trigger the migration, retrieve stored data, and clean up the database.

---

## Features

- **Data Migration**: Processes a `.txt` file and stores the extracted data into MongoDB collections.
- **Queue Processing**: Uses Redis to queue the migration job, ensuring the API remains responsive.
- **RESTful API**: Provides endpoints to trigger migrations, retrieve data, and clean the database.

---

## Steps to Run the Project

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/molero3111/debtors_records
   cd debtors_records
   ```

2. **Start the Docker Containers**:
   ```bash
   docker compose up --build
   ```

3. **Access the API**:
   - The API will be available at `http://localhost:8000`.

---

## API Endpoints

### 1. **GET `/debtors`**
   - **Description**: Returns a list of all debtors registered in the database.
   - **Response Example**:
     ```json
     [
       {
         "id_number": "12345678901",
         "worst_situation": 6,
         "total_loans": 5000.75
       },
       {
         "id_number": "23456789012",
         "worst_situation": 3,
         "total_loans": 1500.50
       }
     ]
     ```

### 2. **POST `/migratedata`**
   - **Description**: Triggers the data migration process.
   - **How It Works**:
     - Dispatches a background job to read the `deudores.txt` file located in the project root.
     - The job parses the file and inserts the data into MongoDB collections.
   - **Response Example**:
     ```json
     {
       "message": "Data migration in progress"
     }
     ```

### 3. **DELETE `/cleandb`**
   - **Description**: Deletes all records from the `debtors` and `entities` collections in MongoDB.
   - **Response Example**:
     ```json
     {
       "message": "Database cleaned successfully"
     }
     ```

---

## Notes

- Ensure that the `deudores.txt` file is present in the root of the project before triggering the migration.
- The project uses Dockerized services for the API, MongoDB, and Redis, so ensure Docker and Docker Compose are installed on your machine.

For any issues or questions, feel free to open an issue in the repository!