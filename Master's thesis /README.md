# 碩士論文：Hybrid Pruning Strategy for Spiking Neural Networks
* **研究背景與目的**：由於模型中引入平衡極端化權重的內穩態機制，使模型雖然可提升準確性卻衍伸出訓練時間過長的問題。為此，本研究對SNN模型架構中使用「混合剪枝」方式進行壓縮，最終成功降低模型訓練時間並維持準確性。

##實驗環境：
* 設備Intel Core i7 12700處理器與32GB DDR4 3200 記憶體，搭載NVIDIA GeForce GTX 1060 （6GB） 顯示卡
* MATLAB版本：R2022b
* Dataset：MNIST
* 訓練資料數量：60,000
* 測試資料數量：10,000
* 訓練週期(Epoch)：20
* 批次大小(Batch Size)：100

