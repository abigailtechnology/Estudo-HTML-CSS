import {
    Box,
    Button,
    Container,
    HStack,
    Modal,
    ModalBody,
    ModalContent,
    ModalHeader,
    ModalOverlay,
    Spacer,
    Text,
    VStack
  } from '@chakra-ui/react'
  import { AsyncSelect } from 'chakra-react-select'
  import Router, { useRouter } from 'next/router'
  import { useEffect, useState } from 'react'
  
  import { useAuthContext } from '../contexts/authContext'
  import { UserInfo } from '../interfaces/user-info.interface'
  
  const Registration: React.FC = () => {
    const { query } = useRouter()
    const [userInfo, setUserInfo] = useState<UserInfo[]>(null)
    const [isOpenUserSelect, setIsOpenUserSelect] = useState<boolean>(true)
    const onCloseUserSelect = () => {
      setIsOpenUserSelect(false)
    }
  
    const { logout } = useAuthContext()
  
    useEffect(() => {
      const user = JSON.parse(localStorage.getItem('auth'))
      setUserInfo(user.user)
    }, [])
  
    const loadOptionsIdentification = (
      inputValue: string,
      callback: (options: any[]) => void
    ) => {
      const valueLabel = userInfo?.map(mat => ({
        value: mat.id,
        label: mat.identification
      }))
      callback(valueLabel)
    }
    const [userIdentification, setUserIdentification] = useState(0)
  
    // console.log(userIdentification)
  
    const handleSetIdentification = users => {
      if (userIdentification !== 0) {
        const selected = users.filter(x => x.id === userIdentification)
        const initialUserList = users
        initialUserList.forEach((element, index) => {
          if (element === selected[0]) initialUserList.splice(index, 1)
        })
        initialUserList.unshift(selected[0])
  
        const userInfo = JSON.parse(localStorage.getItem('auth'))
        userInfo.user = initialUserList
        localStorage.setItem('auth', JSON.stringify(userInfo))
        onCloseUserSelect()
        Router.push('/feed?notification=1')
      }
    }
  
    return (
      <Modal onClose={onCloseUserSelect} isOpen={isOpenUserSelect}>
        <ModalOverlay />
        <ModalContent
          background={
            'radial-gradient(ellipse at center,  #8825fc 0%,#5e00cd 100%)'
          }
        >
          {/* <DrawerCloseButton /> */}
          <ModalHeader>{``}</ModalHeader>
          <Container maxW="6xl" centerContent height={'full'}>
            <ModalBody>
              <Box>
                <VStack>
                  <HStack color="white" fontWeight={'bold'} fontSize={36}>
                    <Text>Esse Login possui mais de uma Matrícula</Text>
                  </HStack>
                  <HStack color="white" fontWeight={'bold'} fontSize={24}>
                    <Text>Selecione abaixo a matrícula desejada</Text>
                  </HStack>
                </VStack>
                <Spacer h={10} />
  
                <AsyncSelect
                  closeMenuOnSelect={true}
                  loadOptions={loadOptionsIdentification}
                  defaultOptions
                  placeholder="Selecione a matrícula"
                  // noOptionsMessage={() => 'Nenhum perfil encontrado'}
                  onChange={val => val.value && setUserIdentification(val.value)}
                />
                <Spacer h={10} />
                <VStack spacing={15}>
                  <Button
                    size="lg"
                    aria-label="Selecionar a matrícula"
                    variant="outline"
                    onClick={() => handleSetIdentification(userInfo)}
                  >
                    Selecionar
                  </Button>
                  <Button
                    size="lg"
                    aria-label="Selecionar a matrícula"
                    variant="outline"
                    onClick={logout}
                  >
                    Sair
                  </Button>
                </VStack>
              </Box>
            </ModalBody>
          </Container>
        </ModalContent>
      </Modal>
    )
  }
  
  export default Registration
  