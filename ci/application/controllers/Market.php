<?php
require_once(APPPATH."controllers/Base_controller.php");

/**
 * Market Controller
 */
class Market extends Base_controller
{
    const MESSAGE_CODE_SELL = 1;
    const MESSAGE_CODE_ERR  = 2;

    /**
     * 商品一覧
     */
    public function index($msg_code = 0)
    {
        /* 必要なモデルをロードする */

        /* t_productions の全データを取得する */

        /* 一覧をビューへ渡す */

        $this->view["pop_message"] = $this->get_error_message($msg_code);
        $this->layout->view('market/index', $this->view);
    }

    /**
     * 販売する
     */
    public function sell()
    {
        /* 必要なモデルをロードする */

        // プログラムトランザクション
        // エラーが起きた際に、 catch (Exception $e) の中に飛ぶ
        try
        {
            // データベーストランザクション
            $this->T_productions->trans_begin();

            /* 必要なデータを取得する */

            /* データを変更・追加 */

            // データベーストランザクション 反映
            $this->T_productions->trans_commit();
        }
        catch (Exception $e)
        {
            // データベーストランザクション 反映させず
            $this->T_productions->trans_rollback();
            $this->_redirect("/market/index/".self::MESSAGE_CODE_ERR);
        }

        // 一覧に戻る
        $this->_redirect("/market/index/".self::MESSAGE_CODE_SELL);
    }

    /**
     * メッセージ取得
     * @param $code
     * @return string
     */
    private function get_error_message($code)
    {
        $errs = [
            self::MESSAGE_CODE_SELL => "購入成功しました",
            self::MESSAGE_CODE_ERR  => "なんらかのエラーが発生しました",
        ];

        return $errs[$code] ?? "";
    }
}
