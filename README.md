# OLMS
A complete Online Library Management System. System have separate login, registration for seperate level of users (Admin, Student, Teacher, Librarian). Librarian assists to students or teachers to issue book. Before issuing any book, system check some core need for example: 1) Same book cannot be issued twice for a particular library user. 2) System does not allow to issue more than 3 books for a particular library user unitl he/she returns the previously issued books. 3) System does not allow to issue book for particular library user if he/she has late fine unpaid. Late fine will be added before he/she if any book is issued and not returned after 7 days. 4) Admin have the full control of this entire system while librarian have limited control. System can feed as many library user as you want.  5) Books can be added to the library maintaining book category, author, isbn number, price, pieces of books. While issuing or receiving book from user the stock of library will automatically be updated. Always reports the stock details. 6) Teachers, Students can issue book from library. They have individual registration, login system so that they can track their issue details. late fine and manage their own profile.
Make sure you have XAMPP installed in your machine. Start xampp(Apache, MySQL).Inside your download zip you will be found database file OLMS.sql. I used MySQL database. So create a database name OLMS and import this database file.
And keep the whole project inside c:/xampp/htdocs folder. Then open browser and type localhost/olms and hit enter.
That's it.
Feel free to have any help while deploying:
MD TARIKUL ISLAM
SKYPE: tarikulislam789
CONTACT: 01926228731
