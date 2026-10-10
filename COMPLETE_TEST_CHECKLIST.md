# School Vehicle — Complete Dynamic Test Checklist

Yeh guide **bina kisi hardcoded script** ke poora system test karne ke liye hai.  
Sab data **Admin Panel → Database → API → Flutter App** se aata hai.

---

## Before you start (one time)

- [ ] XAMPP: **Apache** ON
- [ ] XAMPP: **MySQL** ON (green)
- [ ] Terminal 1:
  ```powershell
  cd c:\xampp\htdocs\SchoolVehicleManagement
  php artisan serve
  ```
- [ ] Browser check: open `http://127.0.0.1:8000/api/v1` → `{"api":"ok","version":"v1"}`
- [ ] Terminal 2 (Flutter Chrome):
  ```powershell
  cd c:\xampp\htdocs\SchoolVehicleApp
  C:\xampp\htdocs\flutter\bin\flutter.bat run -d chrome
  ```

**Login accounts (seed data):**

| Role     | Email                    | Password   |
|----------|--------------------------|------------|
| Admin    | admin@school.com         | password   |
| Driver   | ahmed.khan@school.com    | password   |
| Guardian | fatima.khan@email.com  | password   |

**Demo pair:** Student **Ali Khan** → Guardian **Fatima Khan** → Driver **Ahmed Khan**

---

## PART A — Admin Panel Setup (Backend)

Open: `http://127.0.0.1:8000/login` → Admin login

---

### A1. School location (map red pin)

1. Sidebar → **School** (School Details)
2. Fill:
   - School name
   - **Latitude** (example Lahore: `31.5497`)
   - **Longitude** (example Lahore: `74.3436`)
3. Click **Save / Update**

✅ Done when: school record has lat + lng saved.

---

### A2. Student + Guardian link + Home location (map green pin)

1. Sidebar → **Students**
2. Find **Ali Khan** → click **Edit** (pencil)
3. Check / set:
   - **Name:** Ali Khan
   - **Class:** Grade 1 (or any)
   - **Guardian / Parent:** Fatima Khan
   - **School:** select your school
   - **Latitude (home):** e.g. `31.5204`
   - **Longitude (home):** e.g. `74.3587`
   - (Map pe pin drag karke bhi set kar sakte ho agar map hai)
4. Click **Save / Update**

✅ Done when: Ali Khan → Fatima Khan guardian linked + home lat/lng saved.

---

### A3. Vehicle → Driver link

1. Sidebar → **Vehicles**
2. Open van **KHI-2024-001** (or jo van use karni ho) → **Edit**
3. **Driver:** select **Ahmed Khan**
4. Click **Save**

✅ Done when: vehicle driver = Ahmed Khan.

---

### A4. Create NEW trip (main step — fully dynamic)

1. Sidebar → **Trips**
2. Click **Add Trip** (top right)
3. Fill form **exactly**:

   | Field    | Value                          |
   |----------|--------------------------------|
   | Student  | Ali Khan                       |
   | Vehicle  | KHI-2024-001 (Ahmed's van)     |
   | Route    | Route A - Gulshan to School    |
   | Driver   | Ahmed Khan                     |
   | Status   | **Pending**                    |

4. Click **Save**

✅ Done when: new trip appears in Trips list with status **Pending**.

> **Rule:** Trip ka Driver = Vehicle ka Driver = app login driver.  
> Agar mismatch ho to driver app mein trip nahi dikhegi.

---

### A5. Quick verify in Admin (optional)

1. **Trips** list → filter status **Pending**
2. Confirm: Ali Khan + Ahmed Khan + correct vehicle
3. **Students** → Ali Khan → guardian = Fatima Khan

---

## PART B — Driver App Test

Open Flutter app (Chrome) **OR** second browser window.

1. Login: `ahmed.khan@school.com` / `password`
2. Screen: **My Trips**
3. Check:
   - [ ] Ali Khan trip dikhe
   - [ ] Status: **Pending**
   - [ ] Route + vehicle plate dikhe
4. Tap trip → **Trip detail** screen

### Driver steps (order matters)

| Step | Button              | Expected status   | Guardian should see      |
|------|---------------------|-------------------|--------------------------|
| 1    | On the way          | On the way        | "Driver is on the way"   |
| 2    | Arrived at home     | Arrived           | "Driver has arrived"     |
| 3    | Student boarded     | In progress       | "Live tracking started"  |
| 4    | Complete trip       | Completed         | "Trip completed" alert   |

5. After step 1, check trip detail:
   - [ ] GPS line shows coordinates (web demo GPS near home is OK)

✅ Driver test pass when: all 4 steps success + no error snackbar.

---

## PART C — Guardian App Test

Open **Incognito / second Chrome window** (ya dusra device).

1. Login: `fatima.khan@email.com` / `password`
2. Screen: **My Children**
3. Check:
   - [ ] **Ali Khan** listed
   - [ ] Status badge updates when driver changes steps
   - [ ] Snackbar notifications on status change

### Live map test

1. Tap **Ali Khan** card (when trip active)
2. Map screen open hogi
3. Check pins:
   - [ ] 🟢 **Home** (student lat/lng)
   - [ ] 🔴 **School** (school lat/lng)
   - [ ] 🔵 **Van** (after driver taps "On the way")
4. Wait 5–10 seconds → van position update (polling)
5. Driver **Complete** kare → guardian ko dialog: **Trip completed**

✅ Guardian test pass when: status + map + complete notification all work.

---

## PART D — Run test again (new day / new trip)

No PHP script needed. Admin se:

1. **Trips → Add Trip** (new, status Pending)  
   **OR** edit old trip → status back to **Pending** (testing only)
2. Driver app → pull refresh / reopen trip list
3. Guardian app → refresh

---

## Troubleshooting

| Problem | Fix |
|---------|-----|
| Driver: no trips | Trip driver_id must be Ahmed Khan; status pending/active |
| Guardian: no child | Student parent_id = Fatima's guardian ID |
| Guardian: no active trip | Trip status pending/en_route/arrived/in_progress + student = Ali |
| No school pin | Admin → School → set latitude/longitude |
| No home pin | Admin → Students → Ali → set home lat/lng |
| No van on map | Driver must tap "On the way"; allow location in browser |
| Login / API error | `php artisan serve` running? MySQL on? |
| App can't connect (phone) | `flutter run --dart-define=API_BASE_URL=http://PC_IP:8000` |

---

## Real phone testing

```powershell
# Find PC IP: ipconfig → IPv4 (e.g. 192.168.1.5)
cd c:\xampp\htdocs\SchoolVehicleApp
flutter run --dart-define=API_BASE_URL=http://192.168.1.5:8000
```

Phone and PC must be on **same WiFi**.

---

## What is NOT hardcoded in app

- Trip list → API `/driver/trips`
- Children list → API `/guardian/students`
- Map pins → API `/guardian/trips/{id}/realtime`
- GPS → API `/driver/trips/{id}/locations`
- Status buttons → API driver trip actions

**Only admin creates trips.** App sirf API se data dikhati hai.

---

## 5-minute quick test path

```
1. XAMPP ON + php artisan serve + Flutter Chrome
2. Admin: School lat/lng ✓
3. Admin: Ali Khan → Fatima + home lat/lng ✓
4. Admin: Vehicle → Ahmed driver ✓
5. Admin: Add Trip (Ali, Ahmed, Pending) ✓
6. Driver login → 4 steps ✓
7. Guardian login → map + notifications ✓
```

**Test complete.** ✅
