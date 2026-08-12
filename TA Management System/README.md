# 學校助教申請管理系統 (TA Management System)
<img width="2360" height="1317" alt="IMG_0187" src="https://github.com/user-attachments/assets/88613ff9-66e7-4d00-b9b6-cb5613970b93" />

## 專案簡介
這是一個使用 PHP 開發的助教申請與後台管理系統。主要提供前端表單供使用者填寫資料，並具備管理員專屬的後台介面，方便進行申請資料的讀取、審核與管理。

## 主要功能 (Features)
* **動態表單系統:** 實作申請資料的填寫與安全送出機制 (`form.php`, `formACT.php`)。
* **管理員後台:** 具備獨立的管理員介面，可進行權限控管與資料審查 (`admin.php`)。
* **資料讀取與展示:** 從資料庫動態撈取資料，並於網頁端進行視覺化列表呈現 (`dataRead_show.php`)。
* **後端邏輯處理:** 負責處理前端傳送的請求，並執行對應的資料庫操作 (`act.php`)。

## 技術棧 (Tech Stack)
* **Backend:** PHP
* **Database:** 
* **Frontend:** HTML

## 開發亮點 (Highlights)
* 具備完整的前後端資料傳遞與表單驗證邏輯。
* 實作角色權限劃分（一般使用者 vs. 管理員），確保系統安全性與管理便利性。
