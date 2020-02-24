<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Ankieta;
use AppBundle\Form\FormValidationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnkietaController extends Controller
{
    /**
     * @Route("/ankieta/display", name="app_ankieta_display")
     */
    public function displayAnkieta(){
        $ankieta = $this->getDoctrine()
            ->getRepository('AppBundle:Ankieta')
            ->findAll();

        return $this->render('/ankieta/display.html.twig', array('ankieta'=> $ankieta));
    }

    /**
     * @Route("/ankieta/przystanki", name="app_ankieta_new")
     */
    public function newAction(Request $request) {
        $ankieta = new Ankieta();
        $form = $this->createFormBuilder($ankieta)
            ->add('temat', ChoiceType::class, array('choices'  => array('Ankieta: nowe przystanki' => true,),))
            ->add('tresc', TextareaType::class)
            ->add('rcp', TextType::class)
            ->add('plik1', FileType::class, array('label' => 'Plik1 (pdf,xls,odt,doc,rtf,ods)','required' => false,))
            ->add('plik2', FileType::class, array('label' => 'Plik2 (pdf,xls,odt,doc,rtf,ods)','required' => false,))
            ->add('plik3', FileType::class, array('label' => 'Plik3 (pdf,xls,odt,doc,rtf,ods)','required' => false,))
            ->add('save', SubmitType::class, array('label' => 'Submit'))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //file1
            if (!is_null($ankieta->getPlik1())) {
                $file = $ankieta->getPlik1();
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('ankieta_directory') . '/' . $ankieta->getRcp(), $fileName);
                $ankieta->setPlik1($fileName);
                $ankieta->setLink1($fileName);
            }else{
                $ankieta->setLink1('');
            }
            //file2
            if (!is_null($ankieta->getPlik2())) {
                $file = $ankieta->getPlik2();
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('ankieta_directory') . '/' . $ankieta->getRcp(), $fileName);
                $ankieta->setPlik2($fileName);
                $ankieta->setLink2($fileName);
            }else{
                $ankieta->setLink2('');
            }
            //file3
            if (!is_null($ankieta->getPlik3())) {
                $file = $ankieta->getPlik3();
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('ankieta_directory') . '/' . $ankieta->getRcp(), $fileName);
                $ankieta->setPlik3($fileName);
                $ankieta->setLink3($fileName);
            }else{
                $ankieta->setLink3('');
            }
            //*
            $ankieta = $form->getData();
            $doct = $this->getDoctrine()->getManager();
            $ankieta->setTemat("Ankieta: nowe przystanki");
            // tells Doctrine you want to save the Product
            $doct->persist($ankieta);

            //executes the queries (i.e. the INSERT query)
            $doct->flush();

            return $this->redirectToRoute('app_ankieta_display');
            //*/
            return new Response("User file is successfully uploaded.");
        } else {
            return $this->render('ankieta/przystanki.html.twig', array(
                'form' => $form->createView(),
            ));
        }

    }

    /**
     * @Route("/ankieta/odczyt1/{id}", name="app_ankieta_odczyt1")
     */
    public function getDoc1($id){
        $doct = $this->getDoctrine()->getManager();
        $ankieta = $doct->getRepository('AppBundle:Ankieta')->find($id);
        $ankieta->getLink1();

        $pdfFilename = $ankieta->getLink1();

        $path =  $this->getParameter('ankieta_directory').'/'.$ankieta->getRcp().'/'.$ankieta->getLink1();
        if (!file_exists($path)) {
            return $this->redirectToRoute('app_ankieta_display');;
        }
        header("Content-disposition: attachment; filename=" . $pdfFilename);
        header("Content-type:  application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.oasis.opendocument.text, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, text/rtf, application/vnd.oasis.opendocument.spreadsheet ");
        readfile($path);

        return $this->redirectToRoute('app_ankieta_display');
    }
    /**
     * @Route("/ankieta/odczyt2/{id}", name="app_ankieta_odczyt2")
     */
    public function getDoc2($id){
        $doct = $this->getDoctrine()->getManager();
        $ankieta = $doct->getRepository('AppBundle:Ankieta')->find($id);
        $ankieta->getLink2();

        $pdfFilename = $ankieta->getLink2();

        $path =  $this->getParameter('ankieta_directory').'/'.$ankieta->getRcp().'/'.$ankieta->getLink2();
        if (!file_exists($path)) {
            return $this->redirectToRoute('app_ankieta_display');;
        }
        header("Content-disposition: attachment; filename=" . $pdfFilename);
        header("Content-type:  application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.oasis.opendocument.text, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, text/rtf, application/vnd.oasis.opendocument.spreadsheet ");
        readfile($path);

        return $this->redirectToRoute('app_ankieta_display');
    }
    /**
     * @Route("/ankieta/odczyt3/{id}", name="app_ankieta_odczyt3")
     */
    public function getDoc3($id){
        $doct = $this->getDoctrine()->getManager();
        $ankieta = $doct->getRepository('AppBundle:Ankieta')->find($id);
        $ankieta->getLink3();

        $pdfFilename = $ankieta->getLink3();

        $path =  $this->getParameter('ankieta_directory').'/'.$ankieta->getRcp().'/'.$ankieta->getLink3();
        if (!file_exists($path)) {
            return $this->redirectToRoute('app_ankieta_display');;
        }
        header("Content-disposition: attachment; filename=" . $pdfFilename);
        header("Content-type:  application/pdf, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.oasis.opendocument.text, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, text/rtf, application/vnd.oasis.opendocument.spreadsheet ");
        readfile($path);

        return $this->redirectToRoute('app_ankieta_display');
    }
    /**
     * @Route("/ankieta/delete/{id}", name="app_ankieta_delete")
     */
    public function deletepozycja($id){
        $doct = $this->getDoctrine()->getManager();
        $ankieta = $doct->getRepository('AppBundle:Ankieta')->find($id);

        if (!$ankieta) {
            throw $this->createNotFoundException('No ankieta found for id '.$id);
        }
        $this->deleteDir($this->getParameter('ankieta_directory').'/'.$ankieta->getRcp());

        $doct->remove($ankieta);
        $doct->flush();


        return $this->redirectToRoute('app_ankieta_display');
    }

    /**
     * @Route("/ankieta/szczegoly/{id}", name="app_ankieta_szczegoly")
     */
    public function szczegolypozycja($id){
        $doct = $this->getDoctrine()->getManager();
        $pozycja = $doct->getRepository('AppBundle:Ankieta')->find($id);

        return $this->render('/ankieta/szczegoly.html.twig', ['pozycja'=> $pozycja]);
    }

    private function deleteDir($pathToDir){
        if (is_dir($pathToDir))
            $dir_handle = opendir($pathToDir);
        if (!$dir_handle)
            return false;
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($pathToDir."/".$file))
                    unlink($pathToDir."/".$file);
                else
                    delete_directory($pathToDir.'/'.$file);
            }
        }
        closedir($dir_handle);
        rmdir($pathToDir);
        return true;
    }
}