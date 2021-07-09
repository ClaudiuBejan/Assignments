using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;


namespace StudentReg
{
    class Program
    {
        static void Main(string[] args)
        {
            string question = "go";
            string name;
            DateTime dob;
            int id;
            string subjectid;
            string subjectname;
            string subjectdesc;
            List<Student> students = new List<Student>();
            List<Subject> subjects = new List<Subject>();

            Console.WriteLine(" Hi There!");

            while (question != "exit")
            {
                Console.WriteLine(" \n Choose an option to get started, or type \'exit\' to quit the program.");
                Console.WriteLine("   To register a student, type \'new student\' \n   " +
                    "To add a subject \'add subject\' \n   " +
                    "To add a subject to a student, type \'add subject \' \n   " +
                    "To see student\'s details type \'student details\' \n   " +
                    "To check whether a student is registered with us, type \'validate student\' \n   ");
                question = Console.ReadLine();

                if (question == "new student")
                {
                    Console.WriteLine("Name:");
                    name = Console.ReadLine();
                    Console.WriteLine("Date of birth DD/MM/YYYY:");
                    dob = DateTime.Parse(Console.ReadLine());
                    students.Add(new Student(name, dob.Date));

                    Student curr = students.FirstOrDefault(f => f.name == name);

                    Console.WriteLine("Student has been registered.");
                    Console.WriteLine(curr.Details());

                }
                else if (question == "add subject")
                {
                    Console.WriteLine("ID:");
                    subjectid = Console.ReadLine();
                    Console.WriteLine("Name:");
                    subjectname = Console.ReadLine();
                    Console.WriteLine("Description:");
                    subjectdesc = Console.ReadLine();
                    subjects.Add(new Subject(subjectid, subjectname, subjectdesc));

                    Console.WriteLine("Subject has been registered.");
                    Subject currsubj = subjects.FirstOrDefault(f => f.id == subjectid);
                    Console.WriteLine(currsubj.Details());
                }
                else if (question == "add subject to student")
                {
                    Console.WriteLine("Student name:");
                    name = Console.ReadLine();
                    Console.WriteLine("Subejct ID:");
                    subjectid = Console.ReadLine();

                    Student curr = students.FirstOrDefault(f => f.name == name);
                    curr.AddSubject(subjects.FirstOrDefault(f => f.id == subjectid));

                    Console.WriteLine("Course has been added.");

                }
                else if (question == "validate student")
                {
                    Console.WriteLine("Student name: ");
                    name = Console.ReadLine();
                    if (students.Contains(students.FirstOrDefault(f => f.name == name)))
                    {
                        Student curr = students.FirstOrDefault(f => f.name == name);

                        Console.WriteLine(curr.Details());
                    }
                    else
                    {
                        Console.WriteLine("Student not regitered");
                    }

                }
                else
                {
                    Console.WriteLine("Invalid option.");
                }

            }
        }
    }
}
