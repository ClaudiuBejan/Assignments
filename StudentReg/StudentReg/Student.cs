using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace StudentReg
{
    class Student
    {
        public static int id { get; set; }
        public string name { get; set; }
        public DateTime dob { get; set; }

        List<Subject> subjects = new List<Subject>();

        public Student(string name, DateTime dob)
        {
            this.name = name;
            this.dob = dob;
            id += 1;
        }

        public string Details()
        {
            return
                $"   \n   Student details: \n   " +
                $"----------------------------------- \n   " +
                $"Student id: {id} \n   " +
                $"Name: {this.name} \n   " +
                $"Date of birth: {this.dob.ToString("dd/mm/yyy")} \n   " +
                $"Subjects: {this.ReturnSubjects()} \n   " +
                $"-----------------------------------";
        }

        public void AddSubject(Subject obj)
        {
            subjects.Add(obj);
        }

        public string ReturnSubjects()
        {
            if(subjects.Count < 1)
            {
                return "No subejects added";
            }
            else
            {
                string s = "";
                foreach(var str in subjects)
                {

                    s += str.id;
                    s += " ";
                }
                return $"{s}";
            }
        }

    }
}
