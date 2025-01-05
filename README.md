# School Management System

A simple PHP-based web application to manage students and classes in a school.

---

## What I Have Done

1. **Student Management**:
   - Added functionality to **create**, **view**, **edit**, and **delete** student records.
   - Students can be associated with a class, and their details (name, email, address, and image) are stored in the database.

2. **Class Management**:
   - Added functionality to **create**, **edit**, and **delete** classes.
   - Each class has a unique name and creation timestamp.

3. **Image Upload**:
   - Implemented image upload functionality for student profiles.
   - Images are stored in the `uploads/` directory and displayed on the student list.

4. **Database Integration**:
   - Used **MySQL** to store student and class data.
   - Implemented **CRUD operations** (Create, Read, Update, Delete) using PHP and PDO.

5. **User Interface**:
   - Designed a clean and responsive interface using **Bootstrap**.
   - Added modals for editing classes and students to improve user experience.

---

## Technologies Used

- **Frontend**: HTML, CSS, JS, Bootstrap
- **Backend**: PHP
- **Database**: MySQL
---

## How to Run

1. Clone the repository:
   ```bash
   git clone https://github.com/KarunasriG/student-management-system.git school-demo
   cd school-demo
   ```

2. Set up the database:
   - Create a MySQL database named `school_db`.
   - Use the reference file db folder to create the required tables.

3. Update the `database.php` file with your database credentials.

4. Place the project in your web server's root directory (e.g., `htdocs`).

5. Open the application in your browser:
   ```
   http://localhost/school_demo
   ```

---

## Key Features

- **Add Students**: Enter student details and upload an image.
- **Edit Students**: Update student information using a modal.
- **Delete Students**: Remove students from the database.
- **Manage Classes**: Add, edit, and delete classes.
- **Responsive Design**: Works on all screen sizes.

---

## Screenshots

- **Home Page**: List of all students.
- **Add Student Form**: Form to add a new student.
- **Edit Student Modal**: Modal to edit student details.
- **Manage Classes Page**: List of all classes with options to add, edit, or delete.

---

## What’s Next?

- Add user authentication (login/logout).
- Implement search and pagination for the student list.
- Add more validation and error handling.

---

Enjoy using the School Management System! 🚀

--- 
