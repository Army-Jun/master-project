# 碩士論文：Hybrid Pruning Strategy for Spiking Neural Networks
* **研究背景與目的**：由於模型中引入平衡極端化權重的內穩態機制，使模型雖然可提升準確性卻衍伸出訓練時間過長（上升13倍）的問題。為此，本研究對SNN模型架構中使用「混合剪枝」方式進行壓縮，最終成功降低模型訓練時間並維持準確性。

## 研究貢獻：
提出適用於監督式SNN的動態剪枝演算法架構
引入二維遮罩矩陣與動態控制機制
提出混合剪枝策略突破運算效率瓶頸


## 實驗環境：
* 設備：Intel Core i7 12700處理器與32GB DDR4 3200 記憶體，搭載NVIDIA GeForce GTX 1060 （6GB） 顯示卡
* MATLAB版本：R2022b
* Dataset：MNIST
* 訓練資料數量：60,000
* 測試資料數量：10,000
* 訓練週期(Epoch)：20
* 批次大小(Batch Size)：100

## 實驗結果
準確率變動幅度維持在1%內，訓練時間提升了34%，刪去約60%的參數量

<img width="552" height="330" alt="圖4 3、引入 Homeostasis 機制（Proposed）之五次重複訓練與測試準確率曲線圖。" src="https://github.com/user-attachments/assets/1e0b6859-e385-40ce-8aff-d1abacf7f897" />
<img width="862" height="430" alt="圖4 18、引入 Homeostasis 機制與混合剪枝之五次重複訓練與測試準確率變化曲線圖。" src="https://github.com/user-attachments/assets/96fa124e-9ed4-467f-a008-de63567f7dc6" />
準確率折線圖

 <img width="834" height="656" alt="IMG_0194" src="https://github.com/user-attachments/assets/2eb14118-6ccb-41c0-9197-58d18d7fd19d" />
訓練時間比較長條圖
