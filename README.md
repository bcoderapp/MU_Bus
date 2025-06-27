# 🚌 MU_Bus System

## Overview

MU_Bus is a smart bus management system designed to optimize transportation schedules and respond to user demands in a university or institutional setting. The system enables two primary actors—Admin (Actor) and User—to interact with various features related to schedule management, notifications, and demand analysis.

This project leverages Python technologies for both the backend and frontend:
- **Backend**: FastAPI (modern, fast Python web framework)
- **Frontend**: PyScript (Python in the browser using HTML + Pyodide)

---

## 🛠 Features

### Admin
- ✅ Login/Sign-up
- ✅ Add/Update/Delete Schedule
- ✅ Demand Analysis
- ✅ Add/Update/Delete Notification
- ✅ Add/Update/Delete Decision Pool
- ✅ Logout

### User
- ✅ Login/Sign-up
- ✅ View Bus Schedule
- ✅ Add/Update/Delete Need
- ✅ Get Notified
- ✅ Response to Pool
- ✅ Logout
<!--
---

## 🧰 Tech Stack

| Layer       | Technology     |
|-------------|----------------|
| Backend     | FastAPI        |
| Frontend    | PyScript (HTML + Python) |
| Database    | PostgreSQL or SQLite |
| Authentication | JWT (via FastAPI) |
| Deployment  | Docker + Gunicorn/Uvicorn |

---

## 📁 Project Structure

```bash
mu_bus/
│
├── backend/
│   ├── main.py                # FastAPI main app
│   ├── models.py              # Pydantic models and DB schemas
│   ├── crud.py                # CRUD logic
│   ├── auth.py                # JWT Authentication
│   └── database.py            # Database connection and init
│
├── frontend/
│   ├── index.html             # HTML + PyScript setup
│   ├── scripts/
│   │   ├── login.py           # Login/signup logic
│   │   ├── schedule.py        # View/Add bus schedule
│   │   ├── notification.py    # Notification logic
│   │   └── demand.py          # Demand pool analysis
│
├── requirements.txt           # Python dependencies
├── Dockerfile                 # Docker config
└── README.md
```

---

## 🚀 Getting Started

### Prerequisites
- Python 3.10+
- Docker (optional for containerization)

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/mu_bus.git
cd mu_bus
```

2. **Create virtual environment**
```bash
python -m venv venv
source venv/bin/activate
```

3. **Install dependencies**
```bash
pip install -r requirements.txt
```

4. **Run the FastAPI backend**
```bash
uvicorn backend.main:app --reload
```

5. **Open the frontend**
Just open `frontend/index.html` in your browser. Ensure PyScript is enabled.

---

## 🧪 Running Tests

```bash
pytest tests/
```

---

## 🧩 API Endpoints

Example endpoints from FastAPI:
- `POST /login`
- `GET /schedules`
- `POST /notifications`
- `GET /decision-pool`

Interactive docs available at:  
`http://localhost:8000/docs`

---

## 🔒 Authentication

JWT tokens are issued on login and must be included in request headers for protected endpoints.

```
Authorization: Bearer <token>
```

---

## 📬 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

-->
