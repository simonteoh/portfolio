import Image from 'next/image'
import React from 'react'
import linkedinIcon from '@/public/icons/linkedin-icon.svg'
import mailIcon from '@/public/icons/mail-icon.svg'
import { CommonProps } from '@/type/common.d'

export default function Contact({ className }: CommonProps) {
  return (
    <div id='contact' className={`${className}`}>
      <h1 className='text-black text-4xl md:text-6xl font-extrabold text-center my-12'>Contact</h1>
      <div className='flex flex-wrap md:flex-col md:px-24'>
        <div><h4 className="text-3xl font-semibold text-blue-500">Connect with me</h4><p className="text-gray-500 text-xl">If you want to know more about me or my work, or if you would just<br />like to say hello, send me a message. I&apos;d love to hear from you.</p></div>
        <div className='flex flex-col gap-4 text-xl text-black mt-12 '>
          <div className='flex gap-4'>
            <Image src={mailIcon} alt='email' width={30} height={30} />
            <p>simonteoh1996@gmail.com</p>
          </div>
          <div className='flex break-all gap-4'>
            <Image src={linkedinIcon} alt='Linkedin' width={30} height={30} />
            <p>https://www.linkedin.com/in/simon-teoh-chun-seong-b615751b1/</p>
          </div>
        </div>
      </div>

    </div>
  )
}
