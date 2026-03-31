<?php

namespace Modules\Promotion\Actions;

use Illuminate\Support\Facades\DB;
use Exception;

class TruncatePromotionAction
{
    public function execute(): void
    {
        try {
            DB::beginTransaction();

            // Disable foreign key checks for clean truncation across modules if needed
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            DB::table('promotion_detail_products')->truncate();
            DB::table('promotion_details')->truncate();
            DB::table('promotion_routes')->truncate();
            DB::table('promotion_teams')->truncate();
            DB::table('promotions')->truncate();

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            throw $e;
        }
    }
}
