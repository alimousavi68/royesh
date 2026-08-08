<?php
/**
 * Rooyesh Visual Separator (Divider) Template Part
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<section id="v-rooyesh-divider" class="w-full h-[71px] bg-white flex items-center justify-center overflow-hidden my-6 lg:my-[50px]">
    
    <style>
        @keyframes parallax-up {
            from { transform: translateY(16px); }
            to { transform: translateY(-16px); }
        }
        @keyframes parallax-down {
            from { transform: translateY(-16px); }
            to { transform: translateY(16px); }
        }
        .v-parallax-up {
            animation: parallax-up linear;
            animation-timeline: view();
            animation-range: entry 0% exit 100%;
            will-change: transform;
        }
        .v-parallax-down {
            animation: parallax-down linear;
            animation-timeline: view();
            animation-range: entry 0% exit 100%;
            will-change: transform;
        }
        @keyframes letter-reveal {
            from {
                opacity: 0;
                transform: translateX(-15px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .v-letter-reveal {
            display: inline-block;
            animation: letter-reveal 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }
    </style>
    
    <div dir="ltr" class="w-full max-w-[1150px] h-full px-6 md:px-12 mx-auto flex justify-between items-center relative select-none v-reveal v-reveal-scale-up">
        <div class="absolute inset-0 pointer-events-none" style="background-image: url('<?php echo royesh_asset_img('Dots pattern bg.svg'); ?>'); background-repeat: repeat-x; background-position: center; opacity: 1; z-index: -1;"></div>
        
        <span class="relative z-10 inline-block v-parallax-up">
            <span class="font-['Tilt_Warp'] text-5xl md:text-[68px] font-light leading-none text-[#B1862D]/20 select-none transition-all duration-300 hover:text-[#B1862D]/40 v-letter-reveal" style="animation-delay: 0.1s;">R</span>
        </span>
        
        <span class="relative z-10 inline-block v-parallax-down">
            <span class="font-['Tilt_Warp'] text-5xl md:text-[68px] font-light leading-none text-[#B1862D]/20 select-none transition-all duration-300 hover:text-[#B1862D]/40 v-letter-reveal" style="animation-delay: 0.2s;">O</span>
        </span>
        
        <span class="relative z-10 inline-block v-parallax-up">
            <span class="font-['Tilt_Warp'] text-5xl md:text-[68px] font-light leading-none text-[#B1862D]/20 select-none transition-all duration-300 hover:text-[#B1862D]/40 v-letter-reveal" style="animation-delay: 0.3s;">O</span>
        </span>
        
        <span class="relative z-10 inline-block v-parallax-down">
            <span class="font-['Tilt_Warp'] text-5xl md:text-[68px] font-light leading-none text-[#B1862D]/20 select-none transition-all duration-300 hover:text-[#B1862D]/40 v-letter-reveal" style="animation-delay: 0.4s;">Y</span>
        </span>
        
        <span class="relative z-10 inline-block v-parallax-up">
            <span class="font-['Tilt_Warp'] text-5xl md:text-[68px] font-light leading-none text-[#B1862D]/20 select-none transition-all duration-300 hover:text-[#B1862D]/40 v-letter-reveal" style="animation-delay: 0.5s;">E</span>
        </span>
        
        <span class="relative z-10 inline-block v-parallax-down">
            <span class="font-['Tilt_Warp'] text-5xl md:text-[68px] font-light leading-none text-[#B1862D]/20 select-none transition-all duration-300 hover:text-[#B1862D]/40 v-letter-reveal" style="animation-delay: 0.6s;">S</span>
        </span>
        
        <span class="relative z-10 inline-block v-parallax-up">
            <span class="font-['Tilt_Warp'] text-5xl md:text-[68px] font-light leading-none text-[#B1862D]/20 select-none transition-all duration-300 hover:text-[#B1862D]/40 v-letter-reveal" style="animation-delay: 0.7s;">H</span>
        </span>
        
    </div>
</section>
