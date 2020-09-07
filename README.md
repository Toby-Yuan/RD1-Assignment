# RD1-Assignment
研發一處 實作

# 題目
## 個人氣象網站
1. 縣市可選擇
2. 顯示當前天氣
3. 顯示未來天氣(2天, 1週)
4. 過去1小時, 24小時累積雨量
5. 切換顯示顯示圖片
6. 抓取資料放進資料庫

# 所需資料
## 一般天氣預報-36hr
1. 縣市名稱
2. 天氣敘述
3. 天氣敘述代號
4. 降雨機率

## 局屬氣象站-現在天氣
1. 縣市名稱
2. 鄉鎮名稱
3. 氣溫
4. 最高氣溫
5. 最低氣溫
6. 站名

## 雨量站-雨量觀測
1. 站名
2. 一小時降雨
3. 一天降雨
4. 本日降雨

# 資料庫(請先複製資料庫格式)
- database.sql

# MVC網址
- http://localhost:8888/RD1-Assignment/MVCmod/hello

# 進度
- 08/28 11:43 建立初始資料
- 08/28 14:11 選單連動
- 08/28 15:22 顯示縣市照片
- 08/28 15:58 顯示天氣狀況
- 08/31 09:21 顯示未來天氣預報
- 08/31 10:08 抓取最新資料
- 09/01 12:25 第一次優化(載入: 5->3, 換地區: 6->4)
- 09/01 13:37 第二次優化(載入: 3->1, 換地區: 4->4)
- 09/01 17:20 第三次優化(載入: 1->1, 換地區: 4->3)
- 09/03 16:38 RWD
- 09/07 09:41 備份資料庫
- 09/07 12:11 MVC完成
- 09/07 17:36 新增選擇縣市跳轉頁面- 該縣市所有鄉鎮未來兩天