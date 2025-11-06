# Current Seeker Dashboard Analysis

## 📋 **Current Structure**

### **Layout:**
- **Template**: `resources/views/home.blade.php`
- **Extends**: `layouts/app.blade.php`
- **Layout Type**: Traditional 2-column layout

### **Page Structure:**

1. **Header** (`@include('includes.header')`)
   - Standard site header with logo and navigation
   - Not fixed/persistent
   - User dropdown menu

2. **Page Search Section** (Hidden by default)
   - `.pageSearch` class
   - Search form for jobs
   - Currently `display: none`

3. **Main Wrapper** (`.listpgWraper`)
   - Padding: 40px vertical
   - Background: Default
   - Container with Bootstrap grid

4. **Layout Grid:**
   - **Sidebar**: `col-lg-3` (25% width) - Left side
   - **Main Content**: `col-lg-9` (75% width) - Right side

---

## 🎨 **Current Components**

### **1. Sidebar Navigation** (`includes/user_dashboard_menu.blade.php`)

**Structure:**
- Container: `.usernavwrap`
- Background: White (`#fff`)
- Border Radius: 5px
- Margin Bottom: 30px

**Components:**
- **"Open to Work" Switch** (`.switchbox`)
  - Background: `#ebf3ff` (light blue)
  - Padding: 25px
  - Border Radius: 7px
  - Toggle switch with Yes/No labels

- **Navigation Menu** (`.usernavdash`)
  - List style: None
  - Link padding: `10px 15px`
  - Link color: `#444` (default)
  - Active color: `#0357e9` (primary blue)
  - Icon size: 18px
  - Icon color: `#999` (default), `#0357e9` (active/hover)

**Menu Items:**
1. Dashboard (tachometer icon)
2. Search Jobs (search icon)
3. My Profile (user icon)
4. View Public Profile (eye icon)
5. My Job Applications (desktop icon)
6. My Favourite Jobs (heart icon)
7. My Messages (envelope icon)
8. My Followings (user icon)
9. Build Resume (file icon)
10. Manage Resume (file icon)
11. Download CV (print icon)
12. Logout (sign-out icon)

---

### **2. Dashboard Stats** (`includes/user_dashboard_stats.blade.php`)

**Layout:**
- Container: `.profilestat`
- Grid: `row` with 4 columns
- Column classes: `col-lg-3 col-md-3 col-6`

**Stat Cards** (`.inbox`):
- Background: White
- Border: `1px solid #eee`
- Border Radius: 10px
- Padding: `15px 20px`
- Display: Flex with 15px gap
- Hover: Box shadow + background change to `#f7f7f7`

**Stats Displayed:**
1. **Profile Views** (eye icon)
   - Number: Large, bold (30px)
   - Label: Small text (13px, `#666`)

2. **Followings** (user icon)
3. **My CV List** (briefcase icon)
4. **Messages** (envelope icon)

---

### **3. Cover Photo Section** (`.usercoverphoto`)

**Styling:**
- Height: 300px
- Background: `#eee`
- Border Radius: 15px
- Overflow: Hidden
- Position: Relative

**Edit Button:**
- Position: Absolute (top-right)
- Size: 36px × 36px
- Background: White
- Border Radius: 50%
- Box Shadow: `0 0 20px rgba(0, 0, 0, 0.2)`
- Hover: `#0357e9` background, white text

---

### **4. Profile Information** (`.profileban` / `.abtuser`)

**Positioning:**
- Position: Relative
- Margin Top: -70px (overlaps cover photo)
- Background: `#f1f5ff` (light blue)
- Padding: 20px
- Border Radius: 15px
- Margin: 0 50px, 30px bottom

**User Avatar** (`.uavatar`):
- Size: 120px × 120px
- Border Radius: 5px
- Object Fit: Cover

**User Info:**
- Name: 24px, bold, `#2166a4`
- Location: Icon + text, `#737373`
- Phone: Icon + text, `#737373`
- Email: Icon + text, `#737373`

---

### **5. Incomplete Profile Alert** (`.userprofilealert`)

**Styling:**
- Background: `#EEBA00` (warning yellow)
- Padding: `10px 20px`
- Border Radius: 10px
- Display: Flex (space-between, center)
- Animation: `colorChange 6s infinite`
- Text: 16px, bold, white
- Icon: 24px, white, 10px margin-right

**Action Button** (`.editbtbn`):
- Background: Black
- Color: White
- Border Radius: 4px
- Padding: 10px
- Hover: `#0357e9` background

---

### **6. Applied Jobs Section** (`.appliedjobswrap`)

**Styling:**
- Margin Bottom: 30px
- Heading: 22px, bold

**Table:**
- Header: `.table-dark` (dark background)
- Border: `1px solid #eee`
- Action Button: Primary blue, `6px 15px` padding

**Columns:**
- Job Title
- Company
- Location
- Applied Date
- Status
- Action

---

### **7. Recommended Jobs** (`.profbox`)

**Styling:**
- Margin Bottom: 30px
- Heading: 22px, `#515050`, bold
- Icon: 24px, 10px margin-right, 60% opacity

**Job Cards** (`.featuredlist`):
- Layout: 3-column grid (`col-lg-4 col-md-6`)
- List style: None
- Card class: `.jobint`

**Card Styling:**
- Background: White
- Padding: 15px
- Border Radius: 20px
- Border: `2px solid #eee`
- Margin Top: 30px
- Transition: `0.4s ease`
- Hover: Border color `#0357e9`, transform translateY(-3px), box shadow

**Card Content:**
- Featured badge: Lightning bolt icon (yellow)
- Job type icon: Briefcase in rounded background
- Job title: 18px, black, hover to `#0357e9`
- Salary: Currency + range + period
- Location: Map marker icon
- Company info: Background `#eef3f7`, padding, rounded
- Company logo: Circular, 60px × 60px
- Date: Grey text

---

### **8. My Followings** (`.followbox`)

**Layout:**
- Container: `.profbox followbox`
- Grid: `row` with 3 columns
- Column classes: `col-lg-4 col-md-6`

**Company Cards** (`.empint` / `.emptbox`):
- Company logo (`.comimg`)
- Company name: Bold, 20px
- Industry: Secondary text
- Location: Icon + text
- Open Jobs: Badge with count

---

## 🎨 **Current Color Scheme**

### **Primary Colors:**
- **Primary Blue**: `#0357e9` (links, buttons, active states)
- **Light Blue**: `#ebf3ff` (switch box background)
- **Background Blue**: `#f1f5ff` (profile info section)
- **Grey Background**: `#f2f6fd` (section backgrounds)

### **Text Colors:**
- **Dark**: `#000` / `#252525` (headings)
- **Medium**: `#444` / `#515050` (body text)
- **Light**: `#666` / `#737373` (secondary text)
- **Grey**: `#999` (icons, borders)

### **Accent Colors:**
- **Warning Yellow**: `#EEBA00` (alerts)
- **Success Green**: `#2bab4f` (success states)
- **Border Grey**: `#eee` / `#e8e8e8` (borders)

---

## 📐 **Typography**

### **Font Families:**
- **Headings**: `'Montserrat', sans-serif` (weights: 300-800)
- **Body**: `'Open Sans', sans-serif` (weights: 400, 400i, 600, 700)

### **Font Sizes:**
- **H1**: 45px
- **H2**: 30px
- **H3**: 22px-25px (section headings)
- **H4**: 20px-24px
- **Body**: 14px (base)
- **Small**: 13px

---

## 🏗️ **Layout Details**

### **Container:**
- Framework: Bootstrap 4/5 Grid
- Main wrapper: `.listpgWraper` (40px vertical padding)
- Container: `.container` (responsive max-width)

### **Grid System:**
- Sidebar: `col-lg-3` (25% on large screens)
- Main Content: `col-lg-9` (75% on large screens)
- Stats: `col-lg-3 col-md-3 col-6` (4 columns → 2 on mobile)
- Job Cards: `col-lg-4 col-md-6` (3 columns → 2 on tablet → 1 on mobile)

### **Spacing:**
- Section Padding: 50px vertical
- Component Margin: 30px bottom
- Card Padding: 15px-20px
- Border Radius: 5px, 10px, 15px, 20px

---

## 📱 **Responsive Behavior**

### **Mobile:**
- Sidebar navigation: Fixed bottom with slide-up animation
- Stats: 2 columns (`col-6`)
- Job cards: 1 column
- Profile info: Stacked layout

### **Breakpoints:**
- Large (lg): ≥992px
- Medium (md): ≥768px
- Small (sm): ≥576px

---

## 🔄 **Current Flow**

1. Header (standard site header)
2. Hidden search section
3. Main wrapper starts
4. Sidebar (left, 25%)
   - Open to Work switch
   - Navigation menu
5. Main content (right, 75%)
   - Incomplete profile alert (if applicable)
   - Dashboard stats (4 cards)
   - Cover photo
   - Profile information (overlaps cover)
   - Applied jobs table
   - Package information (if applicable)
   - Recommended jobs (3-column grid)
   - My followings (3-column grid)

---

## 📝 **Key CSS Classes**

- `.listpgWraper` - Main wrapper
- `.usernavwrap` - Sidebar container
- `.usernavdash` - Navigation menu
- `.switchbox` - Open to Work toggle
- `.profilestat` - Stats container
- `.inbox` - Individual stat card
- `.usercoverphoto` - Cover photo section
- `.profileban` - Profile banner wrapper
- `.abtuser` - About user section
- `.uavatar` - User avatar
- `.userprofilealert` - Alert box
- `.appliedjobswrap` - Applied jobs section
- `.profbox` - Profile box container
- `.featuredlist` - Job listings list
- `.jobint` - Individual job card
- `.followbox` - Followings container

---

## 🎯 **Current Design Characteristics**

1. **Traditional Layout**: 2-column sidebar + main content
2. **Vertical Stacking**: Components stack vertically in main area
3. **Card-based Design**: Stats, jobs, companies use card layouts
4. **Color Scheme**: Primary blue (`#0357e9`) with light blue accents
5. **Spacing**: Generous padding and margins
6. **Hover Effects**: Subtle transitions and color changes
7. **Responsive**: Mobile-first with breakpoint adaptations

---

**Last Updated**: After revert
**Status**: Original dashboard structure restored

