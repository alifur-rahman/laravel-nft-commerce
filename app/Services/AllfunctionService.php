<?php

namespace App\Services;

use App\Models\Affiliate;
use App\Models\AssetRating;
use App\Models\AssetView;
use App\Models\Bid;
use App\Models\Deposit;
use App\Models\NftAsset;
use App\Models\NftAssetImage;
use App\Models\NftCollection;
use App\Models\NftSale;
use App\Models\User;
use App\Models\Withdraw;

class AllfunctionService
{

    public function __call($name, $data)
    {
    }
    public static function __callStatic($name, $data)
    {
        if ($name === 'floor_price') {
            return (new self)->get_floor_price($data[0]);
        }
        // count owners
        if ($name === 'owner_count') {
            return (new self)->get_count_owners($data[0]);
        }
        // count sales
        if ($name === 'sales_count') {
            return (new self)->get_count_sales($data[0]);
        }
        // count views
        if ($name === 'views_count') {
            return (new self)->get_count_views($data[0]);
        }
        // count ratings
        if ($name === 'rating_star') {
            return (new self)->calculate_ratings($data[0]);
        }
        // get asset image
        if ($name === 'asset_image') {
            return (new self)->get_asset_image($data[0]);
        }
        // user photo
        if ($name === 'userPhoto') {
            return (new self)->profile_photo($data[0]);
        }
        if ($name === 'userName') {
            return (new self)->user_name($data[0]);
        }
        // collection profile phpoto
        if ($name === 'collection_profile') {
            return (new self)->get_collection_profile($data[0]);
        }
        // collection thumbnail phpoto
        if ($name === 'collection_thumbnail') {
            return (new self)->get_collection_thumbnail($data[0]);
        }
        // count all nft's
        if ($name === 'all_nft_count') {
            return (new self)->get_all_nft();
        }
        // count all user without admin
        if ($name === 'get_all_user_count') {
            return (new self)->get_all_user_count();
        }
        // count total sale
        if ($name === 'get_total_sales_count') {
            return (new self)->get_total_sales_count();
        }
        // collection count
        if ($name === 'get_all_collection_count') {
            return (new self)->get_all_collection_count();
        }
        // Bid count
        if ($name === 'get_all_bid_counts') {
            return (new self)->get_all_bid_counts($data[0]);
        }
        // Bid user image
        if ($name === 'get_all_bid_users_image') {
            return (new self)->get_all_bid_users_image($data[0]);
        }
        // user total bid
        if ($name === 'get_a_user_total_bid') {
            return (new self)->get_a_user_total_bid($data[0]);
        }
        // user last bid image
        if ($name === 'get_a_user_bid_image') {
            return (new self)->get_a_user_bid_image($data[0]);
        }
        // get total balance
        if ($name === 'balance') {
            return (new self)->get_total_balance($data[0]);
        }
        // nft_image
        if ($name === 'get_nft_image') {
            return (new self)->get_nft_image($data[0]);
        }
        // nft_Name
        if ($name === 'get_nft_asset_name') {
            return (new self)->get_nft_asset_name($data[0]);
        }
        // get user cover photo
        if ($name === 'user_cover_photo') {
            return (new self)->get_user_cover($data[0]);
        }
        // highest bid amount
        if ($name === 'get_highest_bid_amount') {
            return (new self)->get_highest_bid_amount($data[0]);
        }
    }
    // highest bid amount
    private function get_highest_bid_amount($bid_asset_id)
    {
        $highest_bid_amount = Bid::where('asset_id', $bid_asset_id)->max('offer_price');
        return $this->thousand_currency_format($highest_bid_amount);
    }
    private function get_floor_price($asset_id)
    {
        $floor_price = NftSale::where('asset_id', $asset_id)->min('total_price');
        return $this->thousand_currency_format($floor_price);
    }
    // count all owners
    private function get_count_owners($token)
    {
        $count = Affiliate::where('token', $token)->count();
        if ($count == 0) {
            $count = 1;
        }
        return $this->thousand_currency_format($count);
    }
    // get sales count
    private function get_count_sales($asset_id)
    {
        $count = NftSale::where('asset_id', $asset_id)->count();
        return $this->thousand_currency_format($count);
    }
    // get total views
    private function get_count_views($asset_id)
    {
        $count = AssetView::where('asset_id', $asset_id)->count();
        return $this->thousand_currency_format($count);
    }
    // thousand currency format
    private function thousand_currency_format($num)
    {
        if ($num > 1000) {

            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];

            return $x_display;
        }

        return $num;
    }
    // calculate ratings
    private function calculate_ratings($asset_id)
    {
        $four_star = AssetRating::where('asset_id', $asset_id)->where('rate', 4)->count();
        $three_star = AssetRating::where('asset_id', $asset_id)->where('rate', 3)->count();
        $five_star = AssetRating::where('asset_id', $asset_id)->where('rate', 5)->count();
        $two_star = AssetRating::where('asset_id', $asset_id)->where('rate', 2)->count();
        $one_star = AssetRating::where('asset_id', $asset_id)->where('rate', 1)->count();
        $total_num_ratings = ($four_star + $five_star + $three_star + $two_star + $one_star);
        if ($total_num_ratings != 0) {
            $avg = round((((1 * $one_star) + (2 * $two_star) + (3 * $three_star) + (4 * $four_star) + (5 * $five_star)) / $total_num_ratings), 2);
        } else {
            $avg = $total_num_ratings;
        }


        // star print

        // get integer value of $averageScore
        $wholeStarCount = (int) $avg;
        // get integer value of 5 - $avg
        $noStarCount    = (int) (5 - $avg);
        // is $avg - $wholeStarCount larger than 0?
        $hasHalfStar    = $avg - $wholeStarCount > 0;

        $stars = str_repeat('<i class="fas fa-star text-warning"></i>' . PHP_EOL, $wholeStarCount) .
            ($hasHalfStar ? '<i class="fas fa-star-half-alt text-warning"></i>' . PHP_EOL : '') .
            str_repeat('<i class="far fa-star text-success"></i>' . PHP_EOL, $noStarCount);
        return $stars;
    }
    // get asset single image
    private function get_asset_image($asset_id)
    {
        $image = NftAssetImage::where('nft_asset_id', $asset_id)->first();
        if (isset($image->image)) {
            $image = asset('Uploads/nft-assets/' . $image->image);
        } else {
            $image = asset('assets/user/images/portfolio/portfolio-05.jpg');
        }
        return $image;
    }
    // get user profile photo
    private function profile_photo($user_id)
    {
        $photo = User::select('profile_photo')->where('id', $user_id)->first();
        if (isset($photo->profile_photo) && $photo->profile_photo != "") {
            $photo = asset('Uploads/profile/' . $photo->profile_photo);
        } else {
            $photo = asset('/assets/user/images/profile/avater-men.png');
        }
        return $photo;
    }
      // get user name
      private function user_name($user_id)
      {
          $name = User::select('name')->where('id', $user_id)->first();

          return $name->name;
      }
    // get collections profile
    private function get_collection_profile($collection_id)
    {
        $photo = NftCollection::select('profile_photo')->where('id', $collection_id)->first();
        if (isset($photo->profile_photo) && $photo->profile_photo != "") {
            $photo = asset('Uploads/profile/' . $photo->profile_photo);
        } else {
            $photo = asset('/assets/user/images/profile/avater-men.jpg');
        }
        return $photo;
    }
    // get collection thumbnail
    private function get_collection_thumbnail($collection_id)
    {
        $photo = NftCollection::select('cover_photo')->where('id', $collection_id)->first();
        if (isset($photo->cover_photo) && $photo->cover_photo != "") {
            $photo = asset('Uploads/cover/' . $photo->cover_photo);
        } else {
            $photo = asset('/assets/userimages/collection/collection-lg-01.jpg');
        }
        return $photo;
    }
    // get all nfts
    private function get_all_nft()
    {
        $count = NftAsset::select('id')->count();
        if ($count) {
            $count = $count;
        } else {
            $count = 0;
        }
        return $count;
    }
    // get all user count
    private function get_all_user_count()
    {
        $user_count = User::select('id')->where('type', 0)->count();
        if ($user_count) {
            $user_count = $user_count;
        } else {
            $user_count = 0;
        }

        return $user_count;
    }
    // get total sale count
    private function get_total_sales_count()
    {
        $sale_count = NftSale::select('id')->count();
        if ($sale_count) {
            $sale_count = $sale_count;
        } else {
            $sale_count = 0;
        }

        return $sale_count;
    }
    // get all collection count
    private function get_all_collection_count()
    {
        $collection_count = NftCollection::select('id')->count();
        if ($collection_count) {
            $collection_count = $collection_count;
        } else {
            $collection_count = 0;
        }

        return $collection_count;
    }
    // get assets bid counts
    private function get_all_bid_counts($id)
    {
        $bid_count = Bid::where('asset_id', $id)->count();
        if ($bid_count) {
            $bid_count = $bid_count;
        } else {
            $bid_count = 0;
        }

        return $bid_count;
    }
    // get all bid users image
    private function get_all_bid_users_image($id)
    {
        $bid_user = Bid::join('users', 'bids.bidder_id', '=', 'users.id')
                        ->where('bids.asset_id', $id)
                        ->select('bids.bidder_id','users.profile_photo','users.name')
                        ->distinct('bids.bidder_id')
                        ->take(3)
                        ->get();

        return $bid_user;
    }
    // get all bid users image
    private function get_a_user_total_bid($id)
    {
        // $user_total_bit = Bid::where('bidder_id',$id)->select('asset_id')->get();
        $user_total_bit = Bid::join('nft_assets', 'nft_assets.id', '=', 'bids.asset_id')
                            ->join('users', 'users.id', '=', 'nft_assets.owner_id')
                            ->where('users.id',$id)
                            ->select('bids.bidder_id')
                            ->get();

        return $user_total_bit->count();
    }
    // get a bid users image
    private function get_a_user_bid_image($id)
    {
        $bid_user = Bid::join('nft_assets', 'nft_assets.id', '=', 'bids.asset_id')
                ->join('users', 'users.id', '=', 'nft_assets.owner_id')
                ->where('users.id',$id)
                ->select('bids.bidder_id')
                ->distinct('bids.bidder_id')
                ->take(3)
                ->get();

        return $bid_user;
    }

    private function get_total_balance($user_id = null)
    {
        // check current balance
        if ($user_id != null) {
            $user_id = $user_id;
        } else {
            $user_id = auth()->user()->id;
        }
        $total_deposit = Deposit::where('user_id', $user_id)->sum('amount');
        $total_withdraw = Withdraw::where('user_id', $user_id)->sum('amount');
        $total_balance = $total_deposit - $total_withdraw;
        return $total_balance;
    }

    private function get_nft_image($id){
        $photo = NftAssetImage::select('image')->where('nft_asset_id', $id)->first();
        if (isset($photo->image)) {
            $photo = asset('Uploads/nft-assets/' . $photo->image);
        } else {
            $photo = asset('/Uploads/nft-assets/collection-lg-01.jpg');
        }
        return $photo;
    }
    private function get_nft_asset_name($id){
        $photo = NftAsset::select('name')->where('id', $id)->first();
        return $photo->name;
    }
    // get user cover photo
    public function get_user_cover($id=null)
    {
        if ($id == null) {
            $user_id = auth()->user()->id;
        }
        else{
            $user_id = $id;
        }
        $photo = User::select('cover_photo')->where('id',$user_id)->first();
        if (isset($photo->cover_photo)) {
            $photo = asset('Uploads/cover/' . $photo->cover_photo);
        }
        else {
            $photo = asset('assets/user/images/profile/cover-04.png');
        }
        return $photo;
    }
}
