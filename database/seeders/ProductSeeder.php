<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'category_id'=>2,
            'title' => 'MSI GF76 KATANA 17 B13VFK-212XKR',
            'price' => '1199',
            'size'=>'1920х1080',
            'discounted_price' => '1100',
            'discounted_percent' => '25',
            'images' => json_encode(['product06.png', 'msi01.jpg']),
            'colors' => json_encode(['black', 'grey']),
            'brand'=>'SAMSUNG',
            'description' => 'Screen  17.3" FHD (1920x1080), 144Hz refresh rate, IPS level.
                    CPU	13th Gen Intel® Core™ i7-13620H 10 Cores (6 P Cores + 4 E Cores), 4.9 GHz Max Turbo Frequency.
                    RAM	8GB*2, DDR5-5200.
                    Video card	NVIDIA ® GeForce RTX™ 4060 Laptop GPU Boost clock speed up to 2250 MHz 105 W maximum graphics power with dynamic boost. 8 GB GDDR6',
            'details' => 'Ports	Gigabit Ethernet -1x Microphone/Headphone combo -1x Type-C (USB3.2 Gen1/DP) 2x Type-A USB3.2 Gen1 -1x Type-A USB2.0 -1x HDMI™ 2.1 (8K@60Hz/ 4K@120Hz) HDMI™.
                    Additionally	Web Camera HD (30fps at 720p) -2x 2W Nahimic 3 Audio Enhancer Hi-Res Audio Ready Speaker -3 Cell 53.5Wh Battery -4-Zone RGB Gaming Keyboard -MSI GF76 KATANA 17 B13VFK-212XKR',
            'created_at'=>'2024-03-10 18:04:11',
    ]);
        DB::table('products')->insert([
            'category_id'=>2,
            'title' => 'Victus by HP 16',
            'price' => '800',
            'size'=>'1920х1080',
            'discounted_price' => null,
            'discounted_percent' => '30',
            'images' => json_encode(['victus.jpg', 'victus01.jpg','victus02.jpg','victus03.jpg']),
            'colors' => json_encode(['black', 'grey',' Low Blue Light']),
            'brand'=>'SAMSUNG',
            'description' => 'Screen	—40.9 cm (16.1") diagonal FHD (1920 x 1080), 144 Hz, 7 ms response time, IPS, thin edges, anti-glare, Low Blue Light, 300 nits, 100% sRGB
                    CPU	—AMD Ryzen™ 7 6800H (up to 4.2 GHz max clock, 16 MB L3 cache, 8 cores, 16 threads)
                    RAM	—16 GB DDR4-3200 MHz RAM (2 x 8 GB)',
            'details' => 'Ports	—Built-in LAN 10/100/1000 GbE / 1 multi-format SD card reader / 1 SuperSpeed ​​USB Type-C® port with data transfer rates of 5 Gbps (DisplayPort™ 1.4, HP Sleep and Charge); 1 SuperSpeed ​​USB Type-A port with data transfer speed of 5 Gbps (HP Sleep and Charge); 2 SuperSpeed ​​USB Type-A ports with data transfer speed of 5 Gbps; 1 HDMI 2.1; 1 RJ-45 connector; 1 AC smart pin; 1 set of headphones/microphone
Additionally	—200W Smart AC Adapter—4-cell, 70Whr Li-Ion Polymer battery—HP Wide Vision 720p HD Camera with built-in dual digital microphones—Audio from B&O; Dual speakers; HP sound amplifier —Victus by HP 16-e0033ua',
            'created_at'=>'2024-03-10 18:04:11',
    ]);
        DB::table('products')->insert([
            'category_id'=>2,
            'title' => 'Samsung Galaxy Book 3',
            'price' => '1130',
            'size'=>'1920х1080',
            'discounted_price' => '1050',
            'discounted_percent' => '10',
            'images' => json_encode(['Samsung01.jpg','Samsung02.jpg','Samsung03.jpg','Samsung04.jpg']),
            'colors' => json_encode(['black', 'grey']),
            'brand'=>'SAMSUNG',
            'description' => 'Screen	Diagonal 15.6" FHD IPS (1920 x 1080), Antil-glare
CPU	Intel® Core™ i7-1360P (18 MB cache, up to 5.0 GHz, 16 cores)
RAM	16 GB LPDDR4x RAM
HDD	512GB M.2 NVMe™ PCIe® 4.0 SSD
Video card	4 GB
Video card	Intel Arc A350M GDDR6 4GB',
            'details' => 'Wi-Fi/Bluetooth	Wi-Fi 6 (2x2) and Bluetooth® 5.1 combo
Ports	2 x USB-C 1 x HDMI 2 x USB-A 1x micro-CD 1 x Security port 1 x HP port
Audio	Dolby Atmos noise reduction technology
Webcam	720P HD camera
Additionally	Backlit keyboard;',
            'created_at'=>'2024-03-10 18:04:11',
    ]);
        DB::table('products')->insert([
            'category_id'=>2,
            'title' => 'MSI Cyborg 15 A12VE ',
            'price' => '780',
            'size'=>'1920х1080',
            'discounted_price' => '700',
            'discounted_percent' => '20',
            'images' => json_encode(['msi01.jpg','product06.png', 'msi02.jpg','msi03.jpg']),
            'colors' => json_encode(['black', 'grey']),
            'brand'=>'SAMSUNG',
            'description' => 'Screen	Diagonal 15.6-inch display with Full HD resolution (1920 x 1080), 144 Hz, IPS level
CPU	Intel Core i5-12450H 2 GHz (12 MB cache, up to 4.4 GHz, 8 cores: 4 high-performance and 4 energy-efficient)
RAM	8 GB DDR4-3200 SO-DIMM',
            'details' => 'Wi-Fi/Bluetooth	Wi-Fi 6 (802.11ax) (dual band) 2*2 + Bluetooth® 5.1 wireless card
Ports	1 x Type-C (USB3.2 Gen 1 / DP) 2 x USB3.2 Gen 1 Type A 1 x HDMI™ 2.1 (4K@60Hz) 1 x RJ45
Battery	3-cell battery 53.5 (Wh)
Audio	2 speakers 2 W
Webcam	HD camera 720p',
            'created_at'=>'2024-03-10 18:04:11',
    ]);
        DB::table('products')->insert([
            'category_id'=>3,
            'title' => 'Смартфон iPhone 15 Pro max 256GB Титан ',
            'price' => '140',
            'size'=>'76.7x159.9x8.25 mm',
            'discounted_price' => '120',
            'discounted_percent' => '30',
            'images' => json_encode(['iphone1.png','iphone2.png', 'iphone3.png','iphone4.png','iphone6.png']),
            'colors' => json_encode(['Titanium','black', 'grey']),
            'brand'=>'APPLE',
            'description' => 'iPhone 15 Pro Max is the king of smartphones: a huge screen, a powerful processor and an innovative camera.
Advanced technology and stylish design in one device.
iPhone 15 Pro Max features a huge 6.7-inch Super Retina XDR OLED display that delivers unparalleled picture quality. The most powerful processor guarantees smooth and fast operation in any use scenario. The main camera with three lenses, optical stabilization and the “Cine Effect” function allows you to shoot professional-quality photos and videos. Face ID technology provides quick and secure access to your device.
A large battery with fast charging support allows you to use your smartphone all day without recharging. The durable, water- and dust-resistant design makes iPhone 15 Pro Max a reliable everyday companion. Stylish design complements the image of this flagship. If you are looking for a smartphone that will meet your high demands, then the iPhone 15 Pro Max is a great choice.',

            'details' => "Weight	221 g
                            Size	76.7x159.9x8.25 mm
                            Screen diagonal	6.5''–6.9''
                            OS version	ios 17
                            Wi-Fi standard	802.11ax
                            SIM card type	nano-sim+eSIM
                            Model	iPhone 15 Pro max
                            Video processor	Neural Engine
                            Guarantee period	1 year
                            Front camera resolution	12 mp
                            Headphone output	USB Type-C
                            CPU	Apple A17 Pro
                            Built-in memory	256 GB
                            Max. video resolution	3840x2160
                            Number of main (rear) cameras	3
                            Memory card slot	No
                            Wireless interfaces	bluetooth, nfc, wi-fi
                            Main (rear) cameras	48 MP
                            Number of processor cores	6
                            RAM	6 GB
                            operating system	iOS",
            'created_at'=>'2024-03-18 18:04:11',
    ]);
    }
}
