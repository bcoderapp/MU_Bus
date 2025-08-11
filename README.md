# MU-BUS – Bus Management System for Metropolitan University

## 📌 Overview
MU-BUS is a **real-time bus schedule management system** designed for **Metropolitan University**.  
It replaces the outdated PDF-based schedule system with a **modern, connected platform** that improves accessibility, communication, and efficiency for students, faculty, and staff.

The system consists of:
- **Admin Web Application** – For managing schedules, routes, buses, and announcements.
- **User Mobile Application** – Built with Flutter for quick and easy access to schedules, notifications, and feedback submission.

---

## 🚀 Features

### **Admin Web Application**
- Secure admin login/logout
- Dashboard overview
- Manage bus schedules, routes, and bus details
- Announcements and real-time notifications
- Demand analysis and service planning
- Developer support access

### **User Mobile Application**
- User signup/login
- View and search bus schedules
- Receive instant push notifications
- Profile management
- Submit demands and feedback
- View announcements and updates

---

## 🖼 Screenshots

### **Mobile App**
| Home Screen | Bus Schedule | Notifications |
|-------------|--------------|---------------|
| ![Home](screenshots/mobile_home.png) | ![Schedule](screenshots/mobile_schedule.png) | ![Notifications](screenshots/mobile_notifications.png) |

### **Admin Web Panel**
| Dashboard | Schedule Management | Announcements |
|-----------|--------------------|---------------|
| ![Dashboard](screenshots/admin_dashboard.png) | ![Schedule Management](screenshots/admin_schedule.png) | ![Announcements](screenshots/admin_announcements.png) |

---

## 🛠️ Technology Stack

| Component             | Technology Used |
|-----------------------|-----------------|
| **Frontend (Web)**    | HTML, CSS, Bootstrap |
| **Frontend (Mobile)** | Flutter, Dart |
| **Backend**           | PHP, MySQL |
| **Database**          | MySQL |
| **Server**            | Apache (XAMPP) |

---

## 📂 Database Structure
Main tables include:
- `admin` – Admin login credentials
- `developer` – Developer access details
- `users` – Student and staff accounts
- `bus_schedule` – Complete bus schedule data
- `routes` – Predefined bus routes
- `bus_types` – Types of buses
- `bus_demand` – Demand submissions
- `notifications` – Alerts and announcements
- `support_requests` – Feedback and bug reports

---

## 📊 System Models
- **Context Diagram**
- **Use Case Diagram**
- **Entity-Relationship Diagram (ERD)**
- **System Sequence Diagram**

---

## ⚙️ Hardware & Software Requirements

**Admin Side:**
- Intel i3 or higher, 4GB RAM, 500GB storage
- HTML, CSS, Bootstrap, PHP, MySQL, Apache (XAMPP)

**User Side:**
- Android smartphone (2GB RAM+)
- Flutter SDK, Dart, PHP API

---

## 🏗️ Architecture
MU-BUS follows a **client–server architecture**:
- **Clients:** Admin web panel, mobile application
- **Server:** PHP & MySQL handling requests and business logic
- **API Layer:** Secure communication between clients and server
- **Database:** Centralized MySQL for real-time synchronization

---

## 📅 Methodology
The system was developed using the **Agile Software Development Model**:
1. Requirement gathering
2. System analysis
3. UI/UX design
4. Development (Web + Mobile)
5. Integration
6. Testing (unit, integration, user acceptance)
7. Deployment (localhost demo)

---

## 🎯 Objectives
- Replace PDF-based schedules with a real-time system
- Enable centralized management of transport operations
- Provide instant communication via notifications
- Support secure authentication for admins and users
- Collect demand data for improved service planning

---

## 📈 Future Enhancements
- GPS-based bus tracking
- Ticket booking system
- AI-based demand predictions

---

## 👨‍💻 Authors
- **[Borna Rani Bhowmik](https://github.com/bornabhowmik)**  
- **[Md. Yasin Ahmed Mahi](https://github.com/mdyasinahmed)**

---

## 📜 License
This project is for **academic purposes** and is not licensed for commercial use.
