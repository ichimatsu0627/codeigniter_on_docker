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
        $this->load->model("M_productions");
        $this->load->model("T_productions");

        /* t_productions の全データを取得する */
        $m_productions = $this->M_productions->get_all();
        $t_productions = $this->T_productions->get_all();

        /* 一覧をビューへ渡す */
        $this->view["m_productions"] = array_column($m_productions, null, "id");
        $this->view["t_productions"] = $t_productions;
        $this->view["pop_message"]   = $this->get_error_message($msg_code);
        $this->layout->view('market/index', $this->view);
    }

    /**
     * 販売する
     */
    public function sell()
    {
        /* 必要なモデルをロードする */
        $this->load->model("T_productions");
        $this->load->model("T_production_receipts");

        /* アイテムを特定するIDを獲得 */
        $id  = $this->input->get('id');
        $num = $this->input->get('num');

        if (empty($id))
        {
            $this->_redirect("/market/index/".self::MESSAGE_CODE_ERR);
        }

        if (!is_numeric($num) || $num <= 0)
        {
            $this->_redirect("/market/index/".self::MESSAGE_CODE_ERR);
        }

        // プログラムトランザクション
        // エラーが起きた際に、 catch (Exception $e) の中に飛ぶ
        try
        {
            // データベーストランザクション
            $this->T_productions->trans_begin();

            /* 必要なデータを取得する */
            $t_production = $this->T_productions->get_by_id($id);

            if (empty($t_production))
            {
                throw new Exception();
            }

            // 0個よりは少なくならない
            if ($t_production->num < $num)
            {
                throw new Exception();
            }

            /* データを変更・追加 */
            $this->T_productions->update_num($id, $t_production->num - $num);
            $this->T_production_receipts->insert([
                "t_production_id" => $id,
                "price"           => $t_production->price,
                "num"             => $num
            ]);

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
