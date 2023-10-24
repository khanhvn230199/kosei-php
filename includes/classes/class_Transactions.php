<?

/******************************************************
 * Class Transactions
 *
 * Static Transactions Handling
 *
 * Project Name               :  Shopping Themes DVS
 * Package Name                    :
 * Program ID                 :  class_transactions.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  Banglcb
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name        Chng  Req   No    Remarks
 * 1.0        2014/02/10        Banglcb          -        -     -     -
 *
 ********************************************************/
class Transactions extends dbBasic
{
    public function Transactions()
    {
        $this->pkey = "transaction_id";
        $this->tbl = "_transactions";
    }

    //SELECT

    public function getAllTransactionsByUser($user_id, $cond = "")
    {
        global $dbconn;
        $sql = "SELECT a.*, c.ctype, c.name, c.slug, c.image, c.des
				FROM $this->tbl AS a
				INNER JOIN _category AS c ON a.cat_id = c.cat_id
				WHERE a.user_id = $user_id";
        if ($cond != "") {
            $sql .= " AND $cond";
        }
        return $dbconn->GetAll($sql);
    }

    /**
     * Get list Transactions by ID or array ID
     *
     * @param number $id
     */
    public function getListTransactionsById($id = 0)
    {
        $cond = "";
        if (is_numeric($id)) {
            $cond = "transaction_id=$id";
        } else
        if (is_array($id)) {
            $s = implode(',', $id);
            $cond = "transaction_id IN ($s)";
        } else
        if (strpos(',', $id) !== false) {
            $cond = "transaction_id IN ($id)";
        }
        $cond .= " ORDER BY order_no";
        return $this->getAll($cond);
    }

    public static function checkPaymentStatus($cat_id)
    {
        global $dbconn, $core;

        // Check cat
        if (empty($cat_id)) {
            return false;
        }

        // Check is logged in
        $user_id = $core->_USER['user_id'];

        if (empty($user_id)) {
            return false;
        }

        $reg_date = time();

        // Select transaction
        $patern = "^$cat_id$|^$cat_id,|,$cat_id$|,$cat_id,";
        $sql = "SELECT t.*, c.name, c.course_ids FROM _transactions AS t INNER JOIN _category AS c WHERE t.user_id = $user_id AND t.cat_id = c.cat_id AND t.status = 2 AND t.expired_time > $reg_date AND (t.cat_id = $cat_id OR c.course_ids RLIKE '$patern') ORDER BY expired_time DESC LIMIT 1";

        $transaction = $dbconn->GetAll($sql);

        if (empty($transaction)) {
            return false;
        }

        return true;
    }

    /*
     * @return: false => No transaction
     * @return: [status, expire_time, expired]
     */
    public static function getPaymentStatus($cat_id)
    {

        global $dbconn, $core, $clsRewrite;

        // Check is logged in
        $user_id = $core->_USER['user_id'];

        if (empty($user_id)) {
            return false;
        }

        $transaction = null;
        $now = time();

        // Get latest combo transactions
        $patern = "^$cat_id$|^$cat_id,|,$cat_id$|,$cat_id,";
        $sql = "SELECT t.*, c.name, c.course_ids FROM _transactions AS t INNER JOIN _category AS c WHERE t.user_id = $user_id AND t.cat_id = c.cat_id AND (t.cat_id = $cat_id OR c.course_ids RLIKE '$patern') ORDER BY t.expired_time DESC";
        $latestTransactions = $dbconn->GetAll($sql);

        if (is_array($latestTransactions)) {
            $transaction = $latestTransactions[0];

            foreach ($latestTransactions as $item) {
                if ($item['status'] == '2' && $item['expired_time'] > $now) {
                    $transaction = $item;
                    break;
                }
            }
        }

        if (empty($transaction)) {
            return false;
        }

        $combo_link = "";

        if ($transaction['course_ids']) {
            $combo = (new Category)->getOne($transaction['cat_id']);
            $combo_link = $clsRewrite->url_category($combo);
        }

        return [
            'name' => $transaction['name'],
            'combo_link' => $combo_link,
            'status' => $transaction['status'],
            'expired_time' => $transaction['expired_time'],
            'expired' => $transaction['expired_time'] < time(),
        ];
    }
}

// Compare
//        // Get current course purchased
//        $sql = "SELECT t.*, c.name, c.course_ids FROM _transactions AS t INNER JOIN _category AS c WHERE t.user_id = $user_id AND t.cat_id = c.cat_id AND t.status = 2 AND t.cat_id = $cat_id AND t.expired_time > $now ORDER BY t.expired_time DESC LIMIT 1";
//        $transaction = $dbconn->GetAll($sql);
//
//        // Select combo purchased
//        if (empty($transaction)) {
//            $patern = "^$cat_id$|^$cat_id,|,$cat_id$|,$cat_id,";
//            $sql = "SELECT t.*, c.name, c.course_ids FROM _transactions AS t INNER JOIN _category AS c WHERE t.user_id = $user_id AND t.cat_id = c.cat_id AND t.status = 2 AND (t.cat_id = $cat_id OR c.course_ids RLIKE '$patern') AND t.expired_time > $now ORDER BY t.expired_time DESC LIMIT 1";
//            $transaction = $dbconn->GetAll($sql);
//        }
//
//        // Get curent course not purchased yet
//        if (empty($transaction)) {
//            $sql = "SELECT t.*, c.name, c.course_ids FROM _transactions AS t INNER JOIN _category AS c WHERE t.user_id = $user_id AND t.cat_id = c.cat_id AND t.cat_id = $cat_id AND t.expired_time > $now ORDER BY t.expired_time DESC LIMIT 1";
//            $transaction = $dbconn->GetAll($sql);
//        }
//
//        // Get combo not purchased yet
//        if (empty($transaction)) {
//            $sql = "SELECT t.*, c.name, c.course_ids FROM _transactions AS t INNER JOIN _category AS c WHERE t.user_id = $user_id AND t.cat_id = c.cat_id AND (t.cat_id = $cat_id OR c.course_ids RLIKE '$patern') AND t.expired_time > $now ORDER BY t.expired_time DESC LIMIT 1";
//            $transaction = $dbconn->GetAll($sql);
//        }
