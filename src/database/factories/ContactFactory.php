<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        $names = ['鈴木', '佐藤', '田中', '小林', '木村', '高橋', '伊藤', '渡辺', '山本', '加藤', '吉田', '山田', '佐々木', '山口', '松本'];
        $first_names = ['正一', '千代',  '清',  '春',  '正雄',  '花',  '正',  '雅子',  '茂',  '文子',  '武雄',  '良子',  '正治',  '千代子',  '一郎',  '清子',  '次郎',  '静子',  '三郎',  '裕子' ];
        $addresses = ['東京都港区1-1-1', '東京都千代田区2-2-2', '東京都中央区3-3-3', '東京都新宿区4-4-4', '東京都目黒区5-5-5'];
        $buildings = ['AAAビル', 'BBBビル', 'CCCビル', 'DDDビル', 'EEEビル'];

        return [
            //
            'category_id' => $this->faker->numberBetween(1,5),
            'name' => $this->faker->randomElement($names),
            'first_name' => $this->faker->randomElement($first_names),
            'gender' => $this->faker->numberBetween(1,3),
            'email' => $this->faker->safeEmail,
            'tel1' => $this->faker->numberBetween(001,999),
            'tel2' => $this->faker->numberBetween(001,999),
            'tel3' => $this->faker->numberBetween(001,999),
            'address' => $this->faker->randomElement($addresses),
            'building' => $this->faker->randomElement($buildings),
            'detail' => $this->faker->text(10)
        ];
    }
}