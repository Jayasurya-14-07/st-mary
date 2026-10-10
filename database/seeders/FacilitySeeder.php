<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FacilitySetting;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        FacilitySetting::updateOrCreate(
            ['id' => 1],
            [
                'kicker' => 'Facilities',
                'title' => 'Facilities for Learning and Growth.',
                'excerpt' => 'St. Mary’s Convent School provides a safe, welcoming, and child-friendly learning environment with facilities that support the academic, physical, creative, and overall development of our students. The school continually strives to provide the resources and opportunities needed to make learning meaningful, engaging, and enjoyable.',
                'images' => [
                    '/images/facilities/facilities1.jpg',
                    '/images/facilities/facilities2.jpg',
                    '/images/facilities/facilities3.jpg',
                    '/images/facilities/facilities4.jpg',
                ],
            ]
        );

        $items = [
            [
                'title' => 'Smart Board–Enabled Classrooms',
                'slug' => 'smart-board-classrooms',
                'excerpt' => 'Technology-supported classrooms that make teaching and learning more interactive and engaging.',
                'content' => [
                    [
                        'type' => 'TipTap Editor',
                        'data' => [
                            'content' => '<p>Technology-supported classrooms that make teaching and learning more interactive and engaging. Interactive Smart Boards allow teachers to utilize multimedia presentations, educational videos, and dynamic diagrams to make complex concepts simple and engaging for all age groups.</p>',
                        ]
                    ]
                ],
                'feature_image' => '/images/facilities/facilities1.jpg',
                'show_below_slider' => 1,
                'order_by' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Computer Lab',
                'slug' => 'computer-lab',
                'excerpt' => 'A well-equipped space to develop students’ digital literacy and computer skills.',
                'content' => [
                    [
                        'type' => 'TipTap Editor',
                        'data' => [
                            'content' => '<p>A well-equipped space to develop students’ digital literacy and computer skills. Our Computer Lab is equipped with modern desktop systems, high-speed connectivity, and modern educational software. Students receive hands-on training under expert guidance.</p>',
                        ]
                    ]
                ],
                'feature_image' => '/images/facilities/facilities2.jpg',
                'show_below_slider' => 1,
                'order_by' => 2,
                'status' => 1,
            ],
            [
                'title' => 'Science Laboratory',
                'slug' => 'science-laboratory',
                'excerpt' => 'A practical learning environment where students explore scientific concepts through experiments and activities.',
                'content' => [
                    [
                        'type' => 'TipTap Editor',
                        'data' => [
                            'content' => '<p>A practical learning environment where students explore scientific concepts through experiments and activities. Safe equipment and guided lab sessions foster scientific curiosity, experimentation, and critical thinking.</p>',
                        ]
                    ]
                ],
                'feature_image' => '/images/facilities/facilities3.jpg',
                'show_below_slider' => 1,
                'order_by' => 3,
                'status' => 1,
            ],
            [
                'title' => 'Playground',
                'slug' => 'playground',
                'excerpt' => 'Spacious areas that provide opportunities for sports, physical activities, recreation, and overall fitness.',
                'content' => [
                    [
                        'type' => 'TipTap Editor',
                        'data' => [
                            'content' => '<p>Spacious areas that provide opportunities for sports, physical activities, recreation, and overall fitness. Physical education is integral to student growth, nurturing sportsmanship, teamwork, and healthy lifestyle habits.</p>',
                        ]
                    ]
                ],
                'feature_image' => '/images/facilities/facilities4.jpg',
                'show_below_slider' => 1,
                'order_by' => 4,
                'status' => 1,
            ],
            [
                'title' => 'Basketball Court',
                'slug' => 'basketball-court',
                'excerpt' => 'A dedicated space to encourage sportsmanship, teamwork, discipline, and physical development.',
                'content' => [
                    [
                        'type' => 'TipTap Editor',
                        'data' => [
                            'content' => '<p>A dedicated space to encourage sportsmanship, teamwork, discipline, and physical development. Students participate in basketball coaching, house matches, and fitness training sessions.</p>',
                        ]
                    ]
                ],
                'feature_image' => null,
                'show_below_slider' => 0,
                'order_by' => 5,
                'status' => 1,
            ],
            [
                'title' => 'School Transport',
                'slug' => 'school-transport',
                'excerpt' => 'Transport facilities to support the safe and convenient travel of students.',
                'content' => [
                    [
                        'type' => 'TipTap Editor',
                        'data' => [
                            'content' => '<p>Transport facilities to support the safe and convenient travel of students. School buses equipped with trained drivers and attendants ensure smooth daily commuting for students across surrounding areas.</p>',
                        ]
                    ]
                ],
                'feature_image' => null,
                'show_below_slider' => 0,
                'order_by' => 6,
                'status' => 1,
            ],
            [
                'title' => 'Online UPS / Power Backup',
                'slug' => 'online-ups-power-backup',
                'excerpt' => 'Reliable power backup to ensure the smooth functioning of classrooms, laboratories, computers, and other essential facilities.',
                'content' => [
                    [
                        'type' => 'TipTap Editor',
                        'data' => [
                            'content' => '<p>Reliable power backup to ensure the smooth functioning of classrooms, laboratories, computers, and other essential facilities without interruption throughout the school day.</p>',
                        ]
                    ]
                ],
                'feature_image' => null,
                'show_below_slider' => 0,
                'order_by' => 7,
                'status' => 1,
            ],
            [
                'title' => 'Creative and Co-curricular Activities',
                'slug' => 'creative-co-curricular-activities',
                'excerpt' => 'Opportunities for students to develop their talents in art, drawing, craft, music, drill, and other activities.',
                'content' => [
                    [
                        'type' => 'TipTap Editor',
                        'data' => [
                            'content' => '<p>Opportunities for students to develop their talents in art, drawing, craft, music, drill, and other co-curricular activities. Holistic development is nurtured through active participation in inter-house and cultural programs.</p>',
                        ]
                    ]
                ],
                'feature_image' => null,
                'show_below_slider' => 0,
                'order_by' => 8,
                'status' => 1,
            ],
        ];

        foreach ($items as $item) {
            $item['facility_setting_id'] = 1;
            Facility::updateOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
