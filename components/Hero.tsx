"use client"
import Image from 'next/image';
import React from 'react'
import { TypeAnimation } from 'react-type-animation'

export default function Hero() {
    return (
        <div className='bg-[#437fc7] md:mt-0 lg:px-12 flex flex-col md:flex-row items-center md:justify-around md:h-auto w-full'>
            <div className='sm:text-center lg:text-left'>
                <h1 className='text-4xl tracking-tight font-extrabold text-gray-900  md:text-6xl'>Hi I&apos;m Simon 👋</h1>
                <TypeAnimation
                    className='text-gray-900 md:text-5xl'
                    sequence={[
                        'Web Developer',
                        1500,
                        'Frontend Developer',
                        1500,
                        'Software Developer',
                    ]}
                    wrapper="span"
                    speed={15}
                    style={{ display: 'inline-block', height: '1rem', fontWeight: '900' }}
                    repeat={Infinity}
                />
            </div>
            <Image src={"/web_dev_image.svg"} alt='web development' className="w-[500px] h-[500px]" width={0} height={0} priority />
        </div>
    )
}
