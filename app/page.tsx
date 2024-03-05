"use client"
import Image from 'next/image';
import { TypeAnimation } from 'react-type-animation';
import Nav from '@/components/Nav';

import gsap from "gsap";
import { useGSAP } from "@gsap/react";
import About from '@/components/About';
import Contact from '@/components/Contact';
import Project from '@/components/Project';
export default function Home() {

  return (
    <main className='bg-white dark:bg-slate-800'>
      <Nav />
      <section className='px-4 py-12 lg:px-0'>
        <div className='md:mt-0 lg:px-12 flex flex-col md:flex-row items-center md:justify-between md:h-screen'>
          <div className='sm:text-center lg:text-left'>
            <h1 className='text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white md:text-6xl'>Hi I&apos;m Simon 👋</h1>
            <TypeAnimation
              className='text-blue-500 md:text-5xl'
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
        <About/>
        <Project/>
        <Contact/>
      </section>
    </main>
  );
}
