import React from 'react'
import skills from '@/data/skills.json'
import Image from 'next/image'
import { CommonProps } from '@/type/common.d'

export default function About({ className }: CommonProps) {
    return (
        <div id='about' className={`${className}`}>
            <h1 className='text-gray-900 text-4xl md:text-6xl font-extrabold text-center'>About Me</h1>
            <p className='text-blue-500 text-xl md:text-3xl font-extrabold mt-12'>A little bit of me</p>

            <div className='text-base md:text-2xl'>
                <p className='mt-12 text-xl md:text-justify text-gray-500'>I am a <strong>Web Developer</strong> who focus on <strong>Frontend</strong> of course for knowledge to build full-stack web application is doable as well. As a web developer, I am dedicated to crafting seamless digital experiences that captivate and engage users. My expertise lies in frontend development, where I leverage the latest technologies and best practices to ensure optimal performance and usability across various devices and platforms. From conceptualization to deployment, I am committed to delivering high-quality solutions that not only meet but exceed client expectations. With a relentless pursuit of innovation and a drive for excellence, I am constantly observing industry trends to stay at the forefront of web development.<br /><br />

                    For me as a web developer, especially in frontend development, it is important to ensure a great user experience. For example, the web application should be responsive to any device, and it should load as fast as possible. Meanwhile, for the product owner, a user-friendly product will attract more leads to the website, potentially converting them into customers.</p>
            </div>
            <div>
                <p className='text-blue-500 text-xl md:text-3xl font-extrabold mt-12'>Technologies and tools</p>
                <div className='flex flex-wrap mt-8 justify-between'>
                    {skills.map((skill, index) => {
                        return (
                            <div key={index} className='py-2 px-4 bg-gray-50 md:m-4 mx-2 mt-6 rounded-lg flex items-center hover:scale-125 cursor-pointer md:w-48 w-40'>
                                <Image src={skill.icon} alt={skill.name} className="w-[48px] h-[48px]" width={0} height={0} loading='lazy' />
                                <h4 className='text-md ml-4'>{skill.name}</h4>
                            </div>
                        )
                    }
                    )}
                </div>
            </div>
        </div>
    )
}
