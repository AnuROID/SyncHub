# ⚡ SyncHub — Real-Time Collaborative Workspace

SyncHub is a high-performance, real-time task management platform built using **Laravel 12** and **Livewire Volt**.

The application allows teams to collaborate on project boards, synchronize tasks instantly across multiple users, and manage project workflows in a premium **dark-mode environment**.

Every task update, creation, or deletion is synchronized across all connected collaborators **without a single page refresh**, leveraging the power of reactive functional components.

---

# 🚀 Features

## 🔐 Authentication & Authorization
- User registration and secure login via **Laravel Breeze**
- Protected project routes using **custom middleware**
- Role-based visibility (**Owner vs Collaborator**)

---

## ⚡ Real-Time Task Board
- **Instant Sync:** Zero-latency task updates using Livewire Volt  
- **Task CRUD:** Create, edit, and delete tasks in real time  
- **Status Control:** Update task stages *(To Do, In Progress, Done)* with immediate UI feedback  
- **Visual Progress:** Automatic line-through styling for completed tasks  

---

## 👥 Team Collaboration
- **Invite System:** Add teammates to specific projects via email validation  
- **Many-to-Many Logic:** Securely share projects across multiple user accounts  
- **Conflict Prevention:** Database-level protection against duplicate member entries  

---

## 📊 Activity Tracking
- **Audit Trail:** Every task displays the name of the last user who edited it  
- **Owner Labels:** Clearly identifies who created the project vs. who was invited  

---

# 🎨 SyncSketch Live Whiteboard

The core of SyncHub is a **real-time collaborative canvas** built with the **HTML5 Canvas API** and integrated seamlessly into Laravel Livewire.

## Key Technical Features

- **Sub-millisecond Latency**  
  Optimized drawing logic using `requestAnimationFrame` and local coordinate mapping.

- **Memory Management**  
  Implements automatic path purging via `beginPath()` to prevent browser lag during long sessions.

- **Livewire Integration**  
  Uses `wire:ignore` to decouple the high-frequency canvas updates from the Livewire DOM diffing engine.

- **Adaptive Canvas**  
  Responsive drawing area that auto-resizes without losing current sketch data.

---

# 🧰 Tech Stack

## Backend
- Laravel 12
- PHP 8.2+
- Livewire 3 (Volt Functional API)

## Database
- MySQL *(Many-to-Many Pivot Architecture)*

## Frontend
- Tailwind CSS *(Custom Dark Theme)*
- Blade Templates
- Alpine.js

---

# 🗄 Database Schema

## Table: `projects`

| Column | Type | Description |
|------|------|-------------|
| id | integer | Primary key |
| user_id | integer | Owner of the project |
| title | string | Project name |
| description | text | Project details |

---

## Table: `tasks`

| Column | Type | Description |
|------|------|-------------|
| id | integer | Primary key |
| project_id | integer | Linked project |
| last_editor_id | integer | User who last updated the task |
| title | string | Task description |
| status | string | `todo / in_progress / done` |

---

# ⚙️ How It Works

## Collaborative Invitation Flow
Owner enters teammate email
↓
System validates if the user exists
↓
User ID is linked with Project ID
↓
Pivot table stores the relationship
↓
Shared project appears on teammate dashboard


Technical implementation uses:


syncWithoutDetaching()


to safely attach users to projects.

---

## Real-Time Update Flow


User Changes Task Status
↓
Livewire Component Sends Update
↓
Database Updates last_editor_id
↓
UI Syncs Across All Connected Users

---

# 🌐 Routes

| Method | Route | Description |
|------|------|-------------|
| GET | `/dashboard` | View all owned and joined projects |
| GET | `/projects/{id}` | Open specific project workspace |
| LIVEWIRE | `inviteMember` | Add user to project via email |
| LIVEWIRE | `updateStatus` | Sync task progress instantly |

---

# 🔒 Security & Performance

- **Eager Loading**  
  Prevents N+1 query issues when loading team members and task editors.

- **Pivot Table Security**  
  Only authenticated project members can view or edit tasks.

- **Validation Layer**  
  Strict server-side validation for emails and task titles.

- **Atomic Database Operations**  
  Uses `syncWithoutDetaching()` to ensure safe collaboration invites.

---

# 👨‍💻 Author

**Anurag Sharma**  
Computer Science Engineering Student  
Full Stack Developer *(Specializing in Laravel & Real-Time Systems)*

---

# 📄 License

This project is developed for **educational and learning purposes**.
