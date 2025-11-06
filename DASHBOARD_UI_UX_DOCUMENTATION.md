# Jobs Portal v5.0 - Dashboard UI/UX Documentation

## Complete UI/UX Analysis: Seeker & Employer Dashboards

---

## 🎨 **Color Palette & Design System**

### Primary Colors
- **Primary Blue**: `#0357e9` (Main brand color - links, buttons, active states)
- **Dark Blue**: `#00389b` (Featured profile background)
- **Light Blue**: `#ebf3ff` (Switch box background)
- **Sky Blue**: `#55adff` (Alternative button color)
- **Background Blue**: `#f1f5ff` (User info section background)
- **Grey Background**: `#f2f6fd` (Section backgrounds)

### Secondary Colors
- **Success Green**: `#2bab4f` (Success buttons)
- **Warning Yellow**: `#EEBA00` / `#ffb72f` (Alerts, featured pricing)
- **Orange Gradient**: `#ffb72f` → `#ff9000` (Action buttons)
- **Dark Grey**: `#2a2b32` (Dark buttons)
- **Text Dark**: `#000` / `#252525` (Headings)
- **Text Medium**: `#444` / `#515050` (Body text)
- **Text Light**: `#666` / `#737373` (Secondary text)
- **Border Grey**: `#eee` / `#e8e8e8` (Borders, dividers)

### Accent Colors
- **Featured Gold**: `#ffca00` (Featured profile pricing)
- **Purchased Green**: `#70a377` (Purchased package background)
- **Error Red**: `#df0909` (Error states)

---

## 📐 **Typography**

### Font Families
- **Headings**: `'Montserrat', sans-serif` (Weight: 300, 400, 500, 600, 700, 800)
- **Body Text**: `'Open Sans', sans-serif` (Weight: 400, 400i, 600, 700)

### Font Sizes
- **H1**: 45px
- **H2**: 30px
- **H3**: 25px / 22px (section headings)
- **H4**: 20px / 24px
- **H5**: 18px
- **H6**: 16px
- **Body**: 14px (base)
- **Small**: 13px

### Font Weights
- **Headings**: 600-700 (semi-bold to bold)
- **Body**: 400 (regular)
- **Strong**: 700 (bold)

---

## 🏗️ **Layout Structure**

### Container & Grid System
- **Framework**: Bootstrap 4/5 Grid System
- **Container**: `.container` (responsive max-width)
- **Main Wrapper**: `.listpgWraper` (padding, background)
- **Grid Columns**: 
  - Sidebar: `col-lg-3` (25% width on large screens)
  - Main Content: `col-lg-9` (75% width on large screens)

### Spacing System
- **Section Padding**: 50px vertical
- **Component Margin**: 30px bottom
- **Card Padding**: 20px-30px
- **Border Radius**: 
  - Small: 5px
  - Medium: 10px
  - Large: 15px

---

## 👤 **SEEKER DASHBOARD UI/UX**

### 1. **Page Header Section** (`.pageSearch`)
- **Background**: White with padding
- **Height**: `pt-md-5 pb-md-5` (responsive padding)
- **Search Bar**: 
  - Input: Full width with rounded corners
  - Button: Icon button with primary blue background
  - Placeholder: "Enter Skills or job title"

### 2. **Sidebar Navigation** (`.usernavwrap`)
- **Background**: `#fff` (white)
- **Border Radius**: 5px
- **Margin**: 30px bottom
- **Box Shadow**: None (clean, minimal)

#### Navigation Menu (`.usernavdash`)
- **List Style**: None (removed bullets)
- **Link Padding**: `10px 15px`
- **Link Color**: `#444` (default), `#0357e9` (active/hover)
- **Icon Size**: 18px
- **Icon Color**: `#999` (default), `#0357e9` (active/hover)
- **Active State**: 
  - Text color: `#0357e9`
  - Icon color: `#0357e9`
- **Hover Effect**: Color transition to primary blue

#### Menu Items:
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

#### "Open to Work" Switch (`.switchbox`)
- **Background**: `#ebf3ff` (light blue)
- **Padding**: 25px
- **Border Radius**: 7px
- **Text**: Bold, 16px
- **Toggle Switch**: Green switch with "Yes/No" labels

### 3. **Dashboard Stats** (`.profilestat`)
- **Layout**: 4-column grid (`col-lg-3 col-md-3 col-6`)
- **Card Style** (`.inbox`):
  - **Background**: White
  - **Border**: `1px solid #eee`
  - **Border Radius**: 10px
  - **Padding**: `15px 20px`
  - **Display**: Flex with 15px gap
  - **Hover Effect**: 
    - Box shadow: `0px 18px 40px rgb(0 0 0 / 10%)`
    - Background: `#f7f7f7`

#### Stat Cards:
1. **Profile Views** (eye icon)
   - Icon: 30px, `#0357e9`
   - Number: 30px, bold, black
   - Label: 13px, `#666`

2. **Followings** (user icon)
3. **My CV List** (briefcase icon)
4. **Messages** (envelope icon)

### 4. **Cover Photo Section** (`.usercoverphoto`)
- **Height**: 300px
- **Background**: `#eee`
- **Border Radius**: 15px
- **Overflow**: Hidden
- **Edit Button**: 
  - Position: Absolute (top-right)
  - Size: 36px × 36px
  - Background: White
  - Border Radius: 50%
  - Box Shadow: `0 0 20px rgba(0, 0, 0, 0.2)`
  - Hover: `#0357e9` background, white text

### 5. **Profile Information** (`.profileban` / `.abtuser`)
- **Position**: Relative, `-70px` margin-top (overlaps cover photo)
- **Background**: `#f1f5ff` (light blue)
- **Padding**: 20px
- **Border Radius**: 15px
- **Margin**: 0 50px, 30px bottom

#### User Avatar (`.uavatar`)
- **Size**: 120px × 120px
- **Border Radius**: 5px
- **Object Fit**: Cover

#### User Info:
- **Name**: 24px, bold, `#2166a4`
- **Location**: Icon + text, `#737373`
- **Phone**: Icon + text, `#737373`
- **Email**: Icon + text, `#737373`

### 6. **Incomplete Profile Alert** (`.userprofilealert`)
- **Background**: `#EEBA00` (warning yellow)
- **Padding**: `10px 20px`
- **Border Radius**: 10px
- **Display**: Flex (space-between, center)
- **Animation**: `colorChange 6s infinite`
- **Text**: 16px, bold, white
- **Icon**: 24px, white, 10px margin-right
- **Action Button**: Black background, white text, 4px radius

### 7. **Applied Jobs Section** (`.appliedjobswrap`)
- **Margin**: 30px bottom
- **Heading**: 22px, bold
- **Table Style**:
  - **Header**: `.table-dark` (dark background)
  - **Border**: `1px solid #eee`
  - **Action Button**: Primary blue, `6px 15px` padding

### 8. **Recommended Jobs** (`.profbox`)
- **Margin**: 30px bottom
- **Heading**: 22px, `#515050`, bold
- **Icon**: 24px, 10px margin-right, 60% opacity
- **View All Link**: Float right, 14px

#### Job Cards (`.featuredlist`)
- **Layout**: 3-column grid (`col-lg-4 col-md-6`)
- **Featured Badge**: Lightning bolt icon, yellow
- **Card Style**:
  - Border: `1px solid #eee`
  - Padding: 20px
  - Border Radius: 5px
  - Hover: Border color changes to `#0357e9`

### 9. **My Followings** (`.followbox`)
- **Layout**: 3-column grid (`col-lg-4 col-md-6`)
- **Company Cards**:
  - Logo: Circular/square image
  - Company Name: Bold, 20px
  - Industry: Secondary text
  - Location: Icon + text
  - Open Jobs: Badge with count

---

## 🏢 **EMPLOYER DASHBOARD UI/UX**

### 1. **Page Header**
- **Title**: "Welcome to Employer Dashboard"
- **Style**: Same as seeker dashboard header

### 2. **Sidebar Navigation** (`.usernavwrap`)
- **Same styling as seeker dashboard**
- **Menu Items**:
  1. Dashboard (tachometer icon)
  2. Search Talent (search icon)
  3. Edit Account Details (pencil icon)
  4. Company Public Profile (user-alt icon)
  5. Post a Job (desktop icon)
  6. Manage Jobs (black-tie icon)
  7. CV Search Packages (search icon)
  8. Payment History (file-invoice icon)
  9. Unlocked Users (user icon)
  10. Company Messages (envelope icon)
  11. Company Followers (users icon)
  12. Logout (sign-out icon)

### 3. **Dashboard Stats** (`.profilestat`)
- **Layout**: 3-column grid (`col-md-4 col-6`)
- **Stat Cards**:
  1. **Open Jobs** (clock icon)
  2. **Followers** (user icon)
  3. **Messages** (envelope icon)

### 4. **Account Status Alerts** (`.userprofilealert`)
- **Active Account**: Green check icon, success message
- **Inactive Account**: Red X icon, warning message
- **Free Package**: Special styled box with gradient

### 5. **Free Package Box** (`.freepackagebox`)
- **Background**: `#ccc` (grey) with animation
- **Padding**: 25px
- **Display**: Flex with 30px gap
- **Border Radius**: 10px
- **Animation**: `colorChange 6s infinite`
- **Text**: White, 24px heading, 18px paragraph
- **Action Button**: White background, black text, 5px radius

### 6. **Package Information** (`.instoretxt`)
- **Background**: `#f0f1f7` (light grey-blue)
- **Padding**: 30px
- **Border Radius**: 15px
- **Heading**: 16px, bold
- **Currency**: 16px, bold, primary blue
- **Action Links**: Primary blue background, white text

### 7. **CV Search Packages** (`.four-plan`)
- **Layout**: 3-column grid (`col-md-4 col-sm-6 col-xs-12`)
- **Package Cards** (`.boxes`):
  - **Plan Name**: Bold, large text
  - **Price**: Currency symbol + amount (large)
  - **Features**: Check icons with list items
  - **Buy Now Button**: Primary blue, white text, arrow icon

---

## 🎯 **Common UI Components**

### Buttons

#### Primary Button (`.btn-yellow`)
- **Background**: `#0357e9` (primary blue)
- **Color**: White
- **Padding**: `15px 25px`
- **Border Radius**: 8px
- **Box Shadow**: `0px 15px 25px rgba(0,0,0,0.2)`
- **Hover**: White background, black text

#### Success Button (`.btn-success`)
- **Background**: `#2bab4f` (green)
- **Color**: White
- **Same styling as primary**

#### Dark Button (`.btn-dark`)
- **Background**: `#2a2b32` (dark grey)
- **Color**: White
- **Padding**: `10px 25px`
- **Hover**: White background, black text

#### Orange Button (`.button-orng`)
- **Background**: Gradient `#ffb72f` → `#ff9000`
- **Color**: White
- **Padding**: `7px 20px`
- **Border Radius**: 5px
- **Hover**: Reversed gradient

### Tables
- **Header**: Dark background (`.table-dark`)
- **Borders**: `1px solid #eee`
- **Striped Rows**: Alternating background colors
- **Action Buttons**: Primary blue, small padding

### Modals
- **Background**: White
- **Border Radius**: Standard
- **Header**: Bold, 20px
- **Close Button**: Standard Bootstrap style

### Forms
- **Input Fields**: 
  - Border: None (clean look)
  - Focus: Primary blue outline
- **Select Dropdowns**: 
  - Border Radius: 0 (square)
- **Labels**: Standard text color

---

## 📱 **Responsive Design**

### Breakpoints
- **Large (lg)**: ≥992px (Desktop)
- **Medium (md)**: ≥768px (Tablet)
- **Small (sm)**: ≥576px (Mobile)
- **Extra Small (xs)**: <576px (Mobile)

### Mobile Adaptations
- **Sidebar**: Fixed bottom navigation on mobile (`.usernavdash`)
- **Stats Grid**: 2 columns on mobile (`col-6`)
- **Job Cards**: 1 column on mobile
- **Padding**: Reduced on smaller screens

---

## ✨ **Animations & Transitions**

### Transitions
- **Links**: `0.3s ease-in-out`
- **Buttons**: `0.2s ease-in-out`
- **Cards**: `0.4s ease` (hover effects)

### Animations
- **Color Change**: `colorChange 6s infinite` (alerts, package boxes)
- **Fade Text**: jQuery fade in/out effect (8 seconds display)

### Hover Effects
- **Cards**: Box shadow increase, background color change
- **Links**: Color change to primary blue
- **Buttons**: Background color inversion
- **Icons**: Color change to primary blue

---

## 🎨 **Visual Hierarchy**

### Typography Scale
1. **Page Title**: 30px, bold, center
2. **Section Headings**: 22px-25px, bold
3. **Subheadings**: 18px-20px, semi-bold
4. **Body Text**: 14px-16px, regular
5. **Small Text**: 13px, regular

### Color Hierarchy
1. **Primary Actions**: `#0357e9` (blue)
2. **Success/Positive**: `#2bab4f` (green)
3. **Warning/Alert**: `#EEBA00` (yellow)
4. **Text Primary**: `#000` / `#252525` (black)
5. **Text Secondary**: `#666` / `#737373` (grey)

### Spacing Hierarchy
1. **Section Spacing**: 50px vertical
2. **Component Spacing**: 30px bottom
3. **Card Padding**: 20px-30px
4. **Element Spacing**: 10px-15px

---

## 🔍 **Accessibility Features**

- **Icon Labels**: Font Awesome icons with aria-hidden
- **Form Labels**: Proper label associations
- **Color Contrast**: WCAG AA compliant
- **Focus States**: Visible focus indicators
- **Semantic HTML**: Proper heading hierarchy

---

## 📊 **Component Library Summary**

### Seeker Dashboard Components
1. Page Search Header
2. Sidebar Navigation Menu
3. "Open to Work" Toggle Switch
4. Dashboard Stats Cards (4)
5. Cover Photo Section
6. Profile Information Card
7. Incomplete Profile Alert
8. Applied Jobs Table
9. Recommended Jobs Grid
10. My Followings Grid

### Employer Dashboard Components
1. Page Header
2. Sidebar Navigation Menu
3. Dashboard Stats Cards (3)
4. Account Status Alerts
5. Free Package Box
6. Package Information Card
7. CV Search Packages Grid
8. Payment History Section

---

## 🎯 **Design Principles**

1. **Consistency**: Same color scheme and styling across both dashboards
2. **Clarity**: Clear visual hierarchy and information architecture
3. **Accessibility**: High contrast, readable fonts, proper spacing
4. **Responsiveness**: Mobile-first approach with breakpoint adaptations
5. **User Experience**: Intuitive navigation, clear call-to-actions
6. **Visual Feedback**: Hover states, active states, transitions

---

## 📝 **Notes**

- Both dashboards share the same base layout structure
- Color scheme is consistent across seeker and employer views
- Sidebar navigation is identical in structure, different in menu items
- Stats cards use the same styling but different metrics
- Responsive design ensures usability across all devices
- Modern, clean design with professional appearance

---

**Document Version**: 1.0  
**Last Updated**: 2024  
**Framework**: Laravel Blade Templates + Bootstrap + Custom CSS

