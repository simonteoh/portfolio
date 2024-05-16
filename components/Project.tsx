import React from 'react'
import projects from '@/data/projects.json'
import Image from 'next/image'
import { CommonProps } from '@/type/common.d'

export default function Project({ className }: CommonProps) {
  return (
    <div id='projects' className={`${className}`}>
      <h1 className='text-black dark:text-white text-4xl md:text-6xl font-extrabold text-center my-12'>Projects</h1>
      <div className='flex flex-wrap gap-24 md:p-24'>
        {projects.map((project, index) => {
          return (
            <div key={index} className="max-w-lg bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700">
              <Image src={project.image} alt={project.name} className='w-full h-auto' width={500} height={500} />
              <div className="p-5">
                <a href="#">
                  <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                    {project.name}
                  </h5>
                </a>
                <p className="mb-3 font-normal text-gray-700">
                  {project.desc}
                </p>
              </div>
            </div>
          )
        })}
      </div>
    </div>
  )
}
