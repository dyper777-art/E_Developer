<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'user_id' => 2,
                'title' => 'Coffee Shop Website Design',
                'description' => "Calling all coffee aficionados and design enthusiasts! ☕️
As a UI/UX designer, I know the importance of a first sip... I mean, first impression! In today's digital world, your coffee shop's website is a crucial element in attracting customers and showcasing your unique brand.
Get ready to explore the secrets of crafting a website that's as smooth and satisfying as your perfect cup of Joe. We'll delve into the world of user experience, where intuitive navigation and mouthwatering visuals will have coffee lovers clicking \"order\" before you can say \"French press.\"
Whether you're a cozy neighborhood haunt or a sleek, modern roastery, I'll share tips on designing a website that reflects your coffee shop's personality and keeps customers coming back for more.

So, grab your favorite mug and settle in! We're about to brew up some serious design inspiration.

Let me know in the comments what features you think are essential for a coffee shop website, and what design elements would make your local café's online presence truly shine!",
                'price' => 100.00,
                'image' => 'frontend/assets/img/service/Coffe Shop Website Design.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'title' => 'Resturant Website Design',
                'description' => "The \"best\" restaurant for customers depends on the criteria, but based on customer satisfaction surveys, Chick-fil-A is consistently ranked as a top choice in the fast-food category for its customer service. For a more comprehensive view, a great restaurant generally offers delicious food, personalized and friendly service, an enjoyable ambiance, efficient operations, and good value. For fine dining, lists like The World's 50 Best Restaurants highlight globally acclaimed restaurants each year, with Maido in Lima named the best in 2025, notes this Wikipedia article and The World's 50 Best Restaurants website.",
                'price' => 200.00,
                'image' => 'frontend/assets/img/service/Resturant Website Design.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'title' => 'Hotel Website Design',
                'description' => "A hotel website should do more than look good—it should make finding information and booking a stay effortless. Whether it’s a cozy boutique hotel or a high-end resort, the best sites balance style and usability.

Great web design follows key principles that apply across industries. If you’re looking to refine layouts, interactions, or navigation, these UI design examples offer practical insights into what makes a seamless user experience.",
                'price' => 150.00,
                'image' => 'frontend/assets/img/service/Hotel Website Design.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'title' => 'Flower Shop Website Design',
                'description' => "Vigorous and full of life, Bloomex makes a gorgeous homepage with a fabulous flower display. The website presents contents using a box-style layout, leaving white spaces on both sides. It has a simple hero header design, testimonials, imagery display using a slider, and a sidebar menu. It is important to connect effectively with potential clients, this website places the phone number and live chat on the header section. This way, locating where to connect with the business is much easier. Bloomex explicitly displays the discounted items clearly and elegantly to make content more striking. You may also follow their social media accounts for further work details.",
                'price' => 100.00,
                'image' => 'frontend/assets/img/service/Flower Shop Website Design.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'title' => 'Cinema Website Design',
                'description' => "Legend Cinema is the very first international modern cinema in Cambodia. With our mobile application, you can access to our latest movies, informations and promotion in our cinemas.",
                'price' => 100.00,
                'image' => 'frontend/assets/img/service/Cinema Website Design.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'title' => 'Mart or Mall Website Design',
                'description' => "Vegetable Website: Inspirational designs, illustrations, and graphic elements from the world’s best designers. Want more inspiration? Browse our search results…",
                'price' => 120.00,
                'image' => 'frontend/assets/img/service/Mart or Mall Website Design.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'title' => 'HR Management System',
                'description' => "Human Resource Management System, or HRMS, is a set of software solutions used to optimize and automate the management of human resources and related processes throughout the entire life cycle of an employee. In this article, you will learn how to create a human resource management system and integrate it into your business.",
                'price' => 150.00,
                'image' => 'frontend/assets/img/service/HR Management System.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'title' => 'Accountant Management System',
                'description' => "An account management system is a software tool that centralizes and organizes client-related data to help businesses build and maintain customer relationships. It tracks interactions, stores customer information, and helps manage the entire client lifecycle, from initial contact through to renewal and expansion. This system facilitates collaboration, provides a single source of truth for client data, and helps nurture long-term customer loyalty and growth.",
                'price' => 200.00,
                'image' => 'frontend/assets/img/service/Accountant Management System.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'title' => 'Sales Management System',
                'description' => "Sales management software encourages cooperation between sales reps and streamlines common activities. By using a sales management system or CRM, you can increase teamwork, cut down on mundane admin tasks, and ultimately achieve your desired sales goals.",
                'price' => 200.00,
                'image' => 'frontend/assets/img/service/Sale Management System.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'title' => 'Stock Management System',
                'description' => "Inventory management is a phenomenally complex aspect of running a retail business. An inventory management system can simplify this process by automating many of the manual tasks and calculations involved.",
                'price' => 300.00,
                'image' => 'frontend/assets/img/service/Stock Management System.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'title' => 'E-commerce on Telegram bot & WebApp',
                'description' => "E-commerce on Telegram involves using a combination of a Telegram bot and a WebApp to create an online store experience within the messaging app. The bot handles initial interactions, marketing, and order notifications, while the WebApp provides a more robust, visual storefront for browsing and purchasing products, often connecting to a separate backend or e-commerce platform like WooCommerce. This integration automates sales, streamlines customer service, and personalizes the shopping experience.",
                'price' => 100.00,
                'image' => 'frontend/assets/img/service/Telegram Bot & Website.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'title' => 'All Kind of Mobile WebApp',
                'description' => "A mobile web app is a web application that is accessed through a mobile device's browser, without needing to be downloaded and installed from an app store. These applications are built using web technologies like HTML, CSS, and JavaScript, and are designed to be responsive, meaning they adapt to different screen sizes for a usable experience on phones and tablets. Unlike native mobile apps, web apps can be accessed from any device with a compatible browser, making them more cross-platform.",
                'price' => 100.00,
                'image' => 'frontend/assets/img/service/Mobile App.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('services')->insert($services);
    }
}
