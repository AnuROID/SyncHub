
# ⚡ SyncHub — Real-Time Collaborative Workspace

SyncHub is a high-performance, real-time task management platform built using Laravel 12 and Livewire Volt. 
The application allows teams to collaborate on project boards, sync tasks instantly across multiple users, and manage project workflows in a premium dark-mode environment.

Every task update, creation, or deletion is synchronized across all connected collaborators without a single page refresh, leveraging the power of reactive functional components.

---

# Features

### Authentication & Authorization
* User registration and secure login via Laravel Breeze
* Protected project routes using custom middleware
* Role-based visibility (Owner vs. Collaborator)

### Real-Time Task Board
* **Instant Sync:** Zero-latency task updates using Livewire Volt
* **Task CRUD:** Create, edit, and delete tasks in real-time
* **Status Control:** Update task stages (To Do, In Progress, Done) with immediate UI feedback
* **Visual Progress:** Automatic line-through styling for completed tasks

### Team Collaboration
* **Invite System:** Add teammates to specific projects via email validation
* **Many-to-Many logic:** Securely share projects across multiple user accounts
* **Conflict Prevention:** Database-level protection against duplicate member entries

### Activity Tracking
* **Audit Trail:** Every task displays the name of the last user who edited it
* **Owner Labels:** Clearly identifies who created the project vs. who was invited

---

# Tech Stack

**Backend:**
* Laravel 12
* PHP 8.2+
* Livewire 3 (Volt Functional API)

**Database:**
* MySQL (Many-to-Many Pivot Architecture)

**Frontend:**
* Tailwind CSS (Custom Dark Theme)
* Blade Templates
* Alpine.js



---

# Database Schema

### Table: projects
| Column | Type | Description |
| :--- | :--- | :--- |
| id | integer | Primary key |
| user_id | integer | Owner of the project |
| title | string | Project name |
| description | text | Project details |

### Table: tasks
| Column | Type | Description |
| :--- | :--- | :--- |
| id | integer | Primary key |
| project_id | integer | Linked project |
| last_editor_id | integer | User who last updated the task |
| title | string | Task description |
| status | string | todo / in_progress / done |

---

# How It Works

### Collaborative Invitation Flow
1. Owner enters a friend's email
2. System validates if the user exists in the database
3. User ID is linked to Project ID in the pivot table (`syncWithoutDetaching`)
4. The project instantly appears on the friend's dashboard

```
Enter Email
     ↓
Validate User
     ↓
Link via Pivot Table
     ↓
Grant Shared Access
```

---

### Real-Time Update Flow
```
User Changes Task Status
            ↓
Livewire Sends Component Update
            ↓
Database Updates last_editor_id
            ↓
UI Syncs for all Team Members
```

---

# Routes

| Method | Route | Description |
| :--- | :--- | :--- |
| GET | /dashboard | View all owned and joined projects |
| GET | /projects/{id} | Open specific project workspace |
| LIVEWIRE | inviteMember | Add user to project via email |
| LIVEWIRE | updateStatus | Sync task progress instantly |

---

# Security & Performance

* **Eager Loading:** Prevents N+1 query issues when loading team members and task editors.
* **Pivot Table Security:** Only authenticated members can view or edit tasks within a project.
* **Validation:** Strict server-side validation for emails and task titles.
* **Atomic Operations:** Uses `syncWithoutDetaching` to ensure data integrity during team invites.

---

# Author

**Anurag Sharma**
Computer Science Engineering Student
Full Stack Developer (Specializing in Laravel & Real-time Systems)

---

# License

This project is for educational purposes.
```
